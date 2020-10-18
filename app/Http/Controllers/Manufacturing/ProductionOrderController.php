<?php

namespace App\Http\Controllers\Manufacturing;

use App\Color;
use App\Http\Controllers\Controller;
use App\Polymeric;
use App\Product;
use App\ProductionOrder;
use DB;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class ProductionOrderController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return 'بدون وضعیت';
                    } elseif ($row->status == 1) {
                        return 'در صف تولید';
                    } elseif ($row->status == 2) {
                        return 'در حال تولید';
                    }
                })
                ->rawColumns(['action', 'color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function wizard()
    {
        $products = Product::all();
        $polymerics = Polymeric::all();
        $colors = Color::all();

        return view('ProductionOrder.wizard', compact('products', 'polymerics', 'colors'));

    }

    public function detail(Request $request)
    {

        $number = ProductionOrder::where('status', 1)
            ->where('color_id', $request->color_id)
            ->where('product_id', $request->product_id)
            ->sum('number');

        return response()->json($number);

    }

    public function store(Request $request)
    {

        $now_date = new Verta();
        $year = substr($now_date->year, strpos($now_date->year, '://') + 2, 6);
        $ProductionOrder = ProductionOrder::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'number' => $request->number,
            'status' => 0,
            'created' => date("Y/m/d"),
        ]);

        $count = ProductionOrder::where('created', date("Y/m/d"))->
        count();
        $num = $count;
        $ProductionOrderCode = 'P-' . $year . $now_date->month . $now_date->day . $num;
        ProductionOrder::where('id', $ProductionOrder->id)->update([
            'ordercode' => $ProductionOrderCode,
        ]);
        try {
            $number = count(collect($request)->get('polymeric_id'));
            for ($i = 0; $i <= $number; $i++) {
                \DB::table('production_polyeric')->insert([
                    'production_id' => $ProductionOrder->id,
                    'polymeric_id' => $request->get('polymeric_id')[$i],
                    'percentage' => $request->get('percentage')[$i],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);
        }
        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);
    }

    public function edit(ProductionOrder $id)
    {

        $productTitles = DB::table('production_polyeric')
            ->where('production_id', $id->id)
            ->get();
        $products = Product::all();
        $polymerics = Polymeric::all();
        $colors = Color::all();

        return view('ProductionOrder.edit', compact('productTitles', 'id', 'products', 'polymerics', 'colors'));

    }

    public function delete($id)
    {
        $post = ProductionOrder::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        ProductionOrder::find($request->id)->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'number' => $request->number,
        ]);
        try {
            DB::table('production_polyeric')
                ->where('production_id', $request->id)->delete();

            $number = count(collect($request)->get('polymeric_id'));
            for ($i = 0; $i <= $number; $i++) {
                \DB::table('production_polyeric')->insert([
                    'production_id' => $request->id,
                    'polymeric_id' => $request->get('polymeric_id')[$i],
                    'percentage' => $request->get('percentage')[$i],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);
        }
        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);


    }

    public function actions($row)
    {

        $btn = '<a href="' . route('admin.productionorder.edit', $row->id) . '">
                        <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';

        return $btn;

    }


}
