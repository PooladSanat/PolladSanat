<?php

namespace App\Http\Controllers\Sell;

use App\Color;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Polymeric;
use App\Product;
use App\ProductQueue;
use App\Scheduling;
use DB;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class ProductQueueController extends Controller
{
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            ProductQueue::create([
                'invoice_id' => $request['id_success'],
                'date' => $this->convert2english($request['date']),
                'Productionconditions' => $request['Productionconditions'],
                'Priority' => $request['Priority'],
                'history' => $request['history'],
                'Sample' => $request['Sample'],
                'description' => $request['description'],
            ]);
            Invoice::find($request['id_success'])->update([
                'state' => 6,
            ]);
            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollBack();
        }


        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);

    }

    public function list(Request $request)
    {
        $product = \DB::table('detail_invoice_list')->distinct()->get('product_id');
        $products = Product::all();
        if ($request->ajax()) {
            $data = \DB::table('detail_invoice_list')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('productlist.list', compact('products', 'product'));

    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $data = \DB::table('detail_invoice_list')
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = Product::where('id', $row->product_id)->first();
                    return $product->label;
                })
                ->addColumn('user', function ($row) {
                    $product = \App\User::where('id', $row->user_id)->first();
                    return $product->name;
                })
                ->addColumn('color', function ($row) {
                    $color_id = \DB::table('invoice_product')
                        ->where('id', $row->invoice_product)
                        ->pluck('color_id');
                    $color = Color::where('id', $color_id)->first();
                    return $color->name;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('productlist.list');


    }

    public function stored(Request $request)
    {
        \DB::table('detail_invoice_list')
            ->where('id', $request->idi)
            ->update([
                'datem' => $this->convert2english($request->date),
            ]);
        return response()->json(['success' => 'success']);
    }

    public function Soort(Request $request)
    {

        foreach ($request->input('rows', []) as $row) {
            $data = \DB::table('detail_invoice_list')
                ->where('id', $row['id'])->update([
                    'Order' => $row['position']
                ]);
        }
        return response()->json($data);
    }

    public function Liststore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_name.*' => 'required',
            'date' => 'required',
        ], [
            'product_name.*.required' => 'لطفا مقدار بارگیری را مشخص کنید',
            'date.required' => 'لطفا تاریخ را مشخص کنید',
        ]);
        $packs = DB::table('schedulings')->latest('id')->first();
        if (!empty($packs)) {
            $pack = $packs->id;
        } else {
            $pack = 1;
        }
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $number = count(collect($request)->get('product_name'));
                for ($i = 0; $i < $number; $i++) {
                    $numbr = DB::table('invoice_product')
                        ->where('id', $request->get('id_product')[$i])->first();
                    $barn = DB::table('barns_products')
                        ->where('product_id', $numbr->product_id)
                        ->where('color_id', $numbr->color_id)
                        ->first();
                    if (empty($barn)) {
                        return response()->json(['emppty' => 'emppty']);
                    } else {
                        $total = abs($barn->Inventory - $barn->NumberSold);
                    }

                    if ($request->get('product_name')[$i] > $total) {
                        return response()->json(['erro' => 'erro']);
                    }
                    if ($numbr->leftover < $request->get('product_name')[$i]) {
                        return response()->json(['eerrorr' => 'eerrorr']);
                    } else {
                        Scheduling::create([
                            'detail_id' => $request->get('id_product')[$i],
                            'number' => $request->get('product_name')[$i],
                            'user_id' => auth()->user()->id,
                            'type' => $request->type,
                            'Carry' => $request->Carry,
                            'date' => $this->convert2english($request->date),
                            'time' => $request->time,
                            'status' => 0,
                            'description' => $request->description,
                            'pack' => $pack,
                        ]);
                        DB::table('invoice_product')
                            ->where('id', $request->get('id_product')[$i])
                            ->update([
                                'leftover' => $numbr->leftover - $request->get('product_name')[$i],
                            ]);
                        if ($numbr->leftover == $request->get('product_name')[$i]) {
                            DB::table('invoice_product')
                                ->where('id', $request->get('id_product')[$i])->update([
                                    'end' => 1,
                                ]);
                        }
                        DB::table('barns_products')
                            ->where('product_id', $numbr->product_id)
                            ->where('color_id', $numbr->color_id)
                            ->update([
                                'NumberSold' => $barn->NumberSold + $request->get('product_name')[$i],
                            ]);
                    }
                }
                DB::commit();
            } catch (Exception $exception) {
                DB::rollBack();
                return response()->json(['errorr' => 'errorr']);
            }
            return response()->json(['success' => 'success']);
        }
        return Response::json(['error' => $validator->errors()]);


    }

    public function wizard($id)
    {
        $products = \DB::table('detail_invoice_list')
            ->where('id', $id)
            ->first();
        $product = \DB::table('invoice_product')
            ->where('id', $products->invoice_product)->first();


        $namep = Product::where('id', $product->product_id)->first();
        $namec = Color::where('id', $product->color_id)->first();


        $polymerics = Polymeric::all();
        return view('productlist.wizard', compact('polymerics', 'products', 'namec', 'namep'));
    }

    public function actions($row)
    {

        $btn = '<a href="' . route('admin.product.list.wizard', $row->id) . '" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                      >
                        <i class="fa fa-tasks fa-lg" title="ثبت اطلاعات تولید"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="notdate">
                       <i class="fa fa-history fa-lg" title="اعلام تاریخ"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';

        return $btn;

    }

    function convert2english($string)
    {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
}
