<?php

namespace App\Http\Controllers\Sell;

use App\BarnReturns;
use App\BarnsProduct;
use App\BarnTemporary;
use App\Color;
use App\Complaints;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\ModelProduct;
use App\Product;
use App\Returns;
use App\Setting;
use App\User;
use BaconQrCode\Encoder\QrCode;
use Carbon\Carbon;
use DB;
use Gate;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class ReturnsController extends Controller
{
    public function list(Request $request)
    {

        $products = Product::all();
        $customers = Customer::all();
        $colors = Color::all();
        if ($request->ajax()) {
            $data = DB::table('returns')
                ->whereNull('state')
                ->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    $btn = '<a href="' . route('admin.Returns.list.detail.print', $row->id) . '">
                     ' . $row->id . '
                      </a>';
                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    $date = Jalalian::forge($row->created_at)->format('Y/m/d');
                    return $date;
                })
                ->addColumn('costumer_id', function ($row) {
                    $costumer_id = Customer::where('id', $row->customer_id)->first();
                    return $costumer_id->name;
                })
                ->addColumn('user_id', function ($row) {
                    $detail_returns = DB::table('detail_returns')
                        ->where('return_id', $row->id)->first();
                    $invoices = DB::table('invoices')
                        ->where('id', $detail_returns->invoice_id)
                        ->first();
                    $customer = DB::table('users')
                        ->where('id', $invoices->user_id)
                        ->first();
                    return $customer->name;
                })
                ->addColumn('detail_returns', function ($row) {
                    $detail_returns = DB::table('detail_returns')
                        ->whereNull('state')
                        ->where('return_id', $row->id)
                        ->sum('number');
                    return $detail_returns;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'در انتظار بررسی مدیر فروش';
                    } elseif ($row->status == 2) {
                        return 'در انتظار بررسی مدیر عامل';
                    } elseif ($row->status == 4) {
                        return 'در انتظار بررسی QC';
                    } elseif ($row->status == 3) {
                        return 'در انتظار بررسی انبار';
                    } elseif ($row->status == 5) {
                        return 'در انتظار تایید نهایی';
                    } elseif ($row->status == null and $row->return_manager == 2) {
                        return 'رد شده توسط مدیر فروش';
                    } else if ($row->status == 9) {
                        return 'حذف شده';

                    } else {
                        return 'اتمام یافته';
                    }
                })
                ->addColumn('Description_m', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نظر انبار"
                       class="dm">
                       ' . str_limit($row->Description_m, 20) . '
                       </a>&nbsp;&nbsp;';
                    return $btn;
                })
                ->addColumn('Description_v', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نظر انبار"
                       class="df">
                       ' . str_limit($row->Description_v, 20) . '
                       </a>&nbsp;&nbsp;';
                    return $btn;

                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'code', 'Description_m', 'Description_v'])
                ->make(true);
        }
        return view('returns.list', compact('customers', 'colors', 'products'));

    }

    public function scheduling(Request $request)
    {

        if (!empty($request->from_date)) {
            $indate = [$request->from_date];
            $todate = [$request->from_date];
        } else {
            $indate = "1395/04/10";
            $todate = "1450/04/01";
        }


        if ($request->ajax()) {
            $data = DB::table('return_schedulings')
                ->whereBetween('date', array($indate, $todate))
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {
                    $detail_returns = DB::table('detail_returns')
                        ->where('id', $row->detail_id)->first();
                    $returns = DB::table('returns')
                        ->where('id', $detail_returns->return_id)->first();
                    $name = Customer::where('id', $returns->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('user_name', function ($row) {
                    $detail_returns = DB::table('detail_returns')
                        ->where('id', $row->detail_id)->first();
                    $invoices = DB::table('invoices')
                        ->where('id', $detail_returns->invoice_id)->first();
                    $name = User::where('id', $invoices->user_id)->first();
                    return $name->name;
                })
                ->addColumn('product', function ($row) {
                    $detail_returns = DB::table('detail_returns')
                        ->where('id', $row->detail_id)->first();
                    $product = DB::table('products')
                        ->where('id', $detail_returns->product_id)->first();
                    return $product->label;
                })
                ->addColumn('color', function ($row) {
                    $detail_returns = DB::table('detail_returns')
                        ->where('id', $row->detail_id)->first();
                    $product = DB::table('colors')
                        ->where('id', $detail_returns->color_id)->first();
                    return $product->name;
                })
                ->addColumn('end', function ($row) {
                    if ($row->end == null) {
                        return 'در انتظار خروج';
                    } else {
                        return 'خروج کامل';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('returns.lists');

    }

    public function nosuccess(Request $request)
    {

        $detail_returnss = DB::table('detail_returns')->get();
        $products = Product::all();
        $returns = DB::table('returns')->get();
        $customers = Customer::all();
        $colors = Color::all();
        if ($request->ajax()) {
            $data = DB::table('detail_returns')
                ->whereNotNull('state')
                ->whereNull('end')
                ->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $btn = '<input type="checkbox" id="checkbox"
                        name="student_checkbox[]"
                        value=' . $row->id . '
                       class="student_checkbox">';
                    return $btn;
                })
                ->addColumn('code', function ($row) {
                    return $row->return_id;
                })
                ->addColumn('date', function ($row) {
                    $return = DB::table('returns')->where('id', $row->return_id)
                        ->first();
                    $date = Jalalian::forge($return->created_at)->format('Y/m/d');
                    return $date;
                })
                ->addColumn('label', function ($row) {
                    $costumer_id = Product::where('id', $row->product_id)->first();
                    return $costumer_id->label;
                })
                ->addColumn('color', function ($row) {
                    $costumer_id = Color::where('id', $row->color_id)->first();
                    return $costumer_id->name;
                })
                ->addColumn('costumer_id', function ($row) {
                    $return = DB::table('returns')->where('id', $row->return_id)
                        ->first();
                    $costumer_id = Customer::where('id', $return->customer_id)->first();
                    return $costumer_id->name;
                })
                ->addColumn('user_id', function ($row) {


                    $detail_returns = DB::table('detail_returns')
                        ->where('return_id', $row->return_id)->first();
                    $invoices = DB::table('invoices')
                        ->where('id', $detail_returns->invoice_id)
                        ->first();
                    $customer = DB::table('users')
                        ->where('id', $invoices->user_id)
                        ->first();
                    return $customer->name;
                })
                ->addColumn('detail_returns', function ($row) {

                    $detail_returns = DB::table('detail_returns')
                        ->whereNotNull('state')
                        ->where('return_id', $row->return_id)
                        ->sum('number');
                    return $detail_returns;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['checkbox'])
                ->make(true);
        }
        return view('returns.nosuccess', compact('returns', 'detail_returnss', 'customers', 'colors', 'products'));

    }

    public function select(Request $request)
    {
        $id = $request->input('id');

        return response()->json($id);

    }

    public function Liststore(Request $request)
    {


        $created_at = Carbon::now();


        $packs = DB::table('return_schedulings')->latest('id')->first();
        if (!empty($packs)) {
            $pack = $packs->id;
        } else {
            $pack = 1;
        }

        DB::beginTransaction();
        try {
            $number = count(collect($request)->get('product_name'));
            for ($i = 0; $i < $number; $i++) {
                $numbr = DB::table('detail_returns')
                    ->where('id', $request->get('id_product')[$i])->first();
                DB::table('return_schedulings')
                    ->insert([
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
                        'created_at' => $created_at,
                    ]);
                DB::table('detail_returns')
                    ->where('id', $request->get('id_product')[$i])
                    ->update([
                        'end' => 1,
                    ]);
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['errorr' => 'errorr']);
        }
        return response()->json(['success' => 'success']);


    }

    public function exit($id)
    {


        $id_detail = array();
        $detail_id = array();
        $detail_returns = DB::table('return_schedulings')
            ->where('pack', $id)
            ->get();
        foreach ($detail_returns as $detail_return) {
            $id_detail[] = $detail_return->detail_id;
        }
        $details = DB::table('detail_returns')
            ->whereIn('id', $id_detail)
            ->get();
        foreach ($details as $detail) {
            $detail_id[] = $detail->return_id;
        }

        DB::table('barn_temporaries')
            ->whereIn('return_id', $detail_id)
            ->update([
                'status' => 2,
            ]);


        DB::table('return_schedulings')
            ->where('pack', $id)
            ->update([
                'end' => 1,
            ]);
        return response()->json(['success' => 'success']);
    }

    public function store(Request $request)
    {
        $barnproduct = BarnsProduct::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)->first();
        $barnreturn = BarnReturns::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)->first();
        try {
            Returns::create([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'invoice_number' => $request->invoice_number,
                'healthynumber' => $request->healthynumber,
                'wastagenumber' => $request->wastagenumber,
                'date' => $request->date,
                'description' => $request->description,
            ]);
            if (!empty($barnproduct)) {
                BarnsProduct::where('product_id', $request->product_id)
                    ->where('color_id', $request->color_id)
                    ->update([
                        'Inventory' => $barnproduct->Inventory + $request->healthynumber,
                    ]);
            } else {
                BarnsProduct::create([
                    'product_id' => $request->product_id,
                    'color_id' => $request->color_id,
                    'Inventory' => $request->healthynumber,
                ]);
            }
            if (!empty($barnreturn)) {
                BarnReturns::where('product_id', $request->product_id)
                    ->where('color_id', $request->color_id)
                    ->update([
                        'Inventory' => $barnreturn->Inventory + $request->wastagenumber,
                    ]);
            } else {
                BarnReturns::create([
                    'product_id' => $request->product_id,
                    'color_id' => $request->color_id,
                    'Inventory' => $request->wastagenumber,
                ]);
            }
            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollBack();
        }

        return response()->json(['success' => 'success']);

    }

    public function invoice(Returns $returns)
    {
        $users = User::all();
        $customers = Customer::all();
        $products = Product::all();
        $colors = Color::all();
        $setting = Setting::first();
        $modelProducts = ModelProduct::all();
        return view('returns.print', compact('users', 'customers',
            'returns',
            'products', 'colors', 'modelProducts', 'setting'));

    }

    public function delete($id)
    {
        $return_barn = DB::table('return_barn')
            ->where('return_id', $id)
            ->first();
        if ($return_barn) {
            DB::table('returns')->where('id', $id)->update([
                'state' => 1,
                'status' => 9,
            ]);
            DB::table('detail_returns')
                ->where('return_id', $id)
                ->update([
                    'state' => 1,
                ]);
        } else {
            DB::table('returns')->where('id', $id)->delete();
        }
        return response()->json(['success' => 'success']);

    }

    public function dm($id)
    {
        $data = DB::table('returns')
            ->where('id', $id)
            ->first();
        return response()->json($data);

    }

    public function barnadmin(Request $request)
    {


        $detail_returns = DB::table('detail_returns')
            ->whereNull('state')
            ->where('return_id', $request->id_m)->get();
        $v = verta();
        $carbon = Carbon::now();
        if ($request->statusq == 1) {
            DB::table('return_admin')
                ->where('return_id', $request->id_m)
                ->update([
                    'statustwo' => $request->statusq,
                    'descriptiontwo' => $request->descriptionq
                ]);
            DB::table('returns')
                ->where('id', $request->id_m)
                ->update([
                    'status' => 7,
                ]);
            $products = DB::table('detail_returns')
                ->where('return_id', $request->id_m)
                ->where('Healthy', '>', 0)
                ->get();
            $returns = DB::table('detail_returns')
                ->where('return_id', $request->id_m)
                ->where('wastage', '>', 0)
                ->get();
            if (!empty($products)) {
                foreach ($products as $product) {
                    DB::table('receiptproduct')
                        ->insert([
                            'product_id' => $product->product_id,
                            'color_id' => $product->color_id,
                            'number' => $product->Healthy,
                            'date' => Jalalian::forge($carbon)->format('Y/m/d'),
                            'created_at' => $carbon,
                            'Year' => $v->year,
                            'Month' => $v->month,
                        ]);
                }
            }
            if (!empty($returns)) {
                foreach ($returns as $return) {
                    DB::table('receiptreturn')
                        ->insert([
                            'product_id' => $return->product_id,
                            'color_id' => $return->color_id,
                            'number' => $return->wastage,
                            'date' => Jalalian::forge($carbon)->format('Y/m/d'),
                            'created_at' => $carbon,
                        ]);
                }
            }


            foreach ($detail_returns as $detail_return) {

                $details = DB::table('invoice_product')
                    ->where('invoice_id', $detail_return->invoice_id)
                    ->where('product_id', $detail_return->product_id)
                    ->where('color_id', $detail_return->color_id)
                    ->first();
                $price = $detail_return->number * $details->salesPrice;
                $pack_id = DB::table('schedulings')
                    ->where('detail_id', $details->id)
                    ->first();
                $factor = DB::table('factors')
                    ->where('pack_id', $pack_id->pack)
                    ->first();


                DB::table('returns_payment')
                    ->insert([
                        'return_id' => $request->id_m,
                        'customer_id' => $factor->customer_id,
                        'price' => $price,
                        'number_ret' => $detail_return->number,
                        'date' => Jalalian::forge($carbon)->format('Y/m/d'),
                    ]);


//                DB::table('detail_customer_payment')
//                    ->insert([
//                        'customer_id' => $factor->customer_id,
//                        'price' => $price,
//                        'return_id' => $request->id_m,
//                        'descriptionn' => 'بابت مرجوع نمودن فاکتور',
//                        'datee' => Jalalian::forge($carbon)->format('Y/m/d'),
//                    ]);

                DB::table('barn_temporaries')
                    ->where('return_id', $request->id_m)
                    ->update([
                        'status' => 1,
                    ]);
            }
        } else {
            DB::table('return_admin')
                ->where('return_id', $request->id_m)
                ->update([
                    'statustwo' => $request->statusq,
                    'descriptiontwo' => $request->descriptionq
                ]);
            DB::table('returns')
                ->where('id', $request->id_m)
                ->update([
                    'status' => null,
                    'return_manager' => null,
                    'return_admin' => null,
                    'return_barn' => null,
                ]);
        }
        return response()->json(['success' => 'success']);

    }

    public function admi(Request $request)
    {
        $date = Carbon::now();
        DB::table('return_admin')
            ->insert([
                'user_id' => auth()->user()->id,
                'return_id' => $request->ides_,
                'statusone' => $request->statusur,
                'descriptionone' => $request->descriptionur,
                'created_at' => $date,
            ]);
        if ($request->statusur == 1) {
            DB::table('returns')
                ->where('id', $request->ides_)
                ->update([
                    'status' => 3,
                    'return_admin' => $request->statusur,
                ]);
        } else {
            DB::table('returns')
                ->where('id', $request->ides_)
                ->update([
                    'status' => 1,
                    'return_admin' => $request->statusur,
                    'return_manager' => null,
                ]);
        }

        return response()->json(['success' => 'success']);
    }

    public function number(Request $request)
    {

        $state = DB::table('invoices')
            ->where('customer_id', $request->commodity_id)->get();
        return response()->json($state);


    }

    public function storeeupdate(Request $request)
    {


        DB::beginTransaction();
        try {
            $return = Returns::where('id', $request->id_returns)->update([
                'user_id' => auth()->user()->id,
                'customer_id' => $request->customer_idd,
                'Cost' => $request->Carryy,
                'date' => $request->datee,
                'Description_m' => $request->description_mm,
                'Description_v' => $request->description_ff,
                'status' => 1,
                'return_manager' => null,
            ]);
            $return_barn = DB::table('return_barn')
                ->where('return_id', $request->id_returns)
                ->first();

            if ($return_barn) {
                try {
                    $invoice = count(collect($request)->get('productt_'));
                    for ($i = 0; $i < $invoice; $i++) {
                        $detail = \DB::table('detail_returns')
                            ->where('return_id', $request->id_returns)
                            ->where('product_id', $request->get('productt_')[$i])
                            ->where('color_id', $request->get('colorr_')[$i])
                            ->first();
                        \DB::table('detail_returns')
                            ->where('return_id', $request->id_returns)
                            ->where('product_id', $request->get('productt_')[$i])
                            ->where('color_id', $request->get('colorr_')[$i])
                            ->update([
                                'invoice_id' => $request->get('invoicee_')[$i],
                                'product_id' => $request->get('productt_')[$i],
                                'color_id' => $request->get('colorr_')[$i],
                                'number' => $request->get('numberr_')[$i],
                                'number_return' => $detail->number - $request->get('numberr_')[$i],
                                'reason' => $request->get('reasonss_')[$i],
                            ]);
                        DB::table('detail_returns')
                            ->insert([
                                'return_id' => $request->id_returns,
                                'invoice_id' => $request->get('invoicee_')[$i],
                                'product_id' => $request->get('productt_')[$i],
                                'color_id' => $request->get('colorr_')[$i],
                                'number_return' => $detail->number - $request->get('numberr_')[$i],
                                'reason' => $request->get('reasonss_')[$i],
                                'state' => 1,
                            ]);
                        DB::table('returns')
                            ->where('id', $request->id_returns)
                            ->update([
                                'change' => 1,
                            ]);
                        DB::table('detail_returns')->whereNull('number')
                            ->where('number_return', 0)
                            ->delete();
                    }
                } catch (Exception $exception) {
                    return response()->json(['success' => 'success']);
                }
            } else {
                \DB::table('detail_returns')
                    ->where('return_id', $request->id_returns)->delete();
                try {
                    $invoice = count(collect($request)->get('productt_'));
                    for ($i = 0; $i < $invoice; $i++) {

                        DB::table('detail_returns')
                            ->insert([
                                'return_id' => $request->id_returns,
                                'invoice_id' => $request->get('invoicee_')[$i],
                                'product_id' => $request->get('productt_')[$i],
                                'color_id' => $request->get('colorr_')[$i],
                                'number' => $request->get('numberr_')[$i],
                                'reason' => $request->get('reasonss_')[$i],
                            ]);

                    }
                } catch (Exception $exception) {
                    return response()->json(['success' => 'success']);
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'success']);
    }

    public function barn(Request $request)
    {
        $carbon = Carbon::now();
        $id = array();
        $details = DB::table('detail_returns')
            ->whereNull('state')
            ->where('return_id', $request->id_id)
            ->get();
        foreach ($details as $detail) {
            $id[] = $detail->id;
        }

        DB::table('return_qc')
            ->insert([
                'user_id' => auth()->user()->id,
                'return_id' => $request->id_id,
                'status' => 1,
                'description' => $request->descriptionq,
                'created_at' => $carbon,
            ]);
        Returns::where('id', $request->id_id)
            ->update([
                'status' => 5,
            ]);
        try {
            $m = count(collect($request)->get('m'));
            for ($i = 0; $i < $m; $i++) {
                DB::table('detail_returns')->where('id', $id[$i])
                    ->update([
                        'Healthy' => $request->get('s')[$i],
                        'wastage' => $request->get('m')[$i],
                        'wastagem' => $request->get('ss')[$i],
                    ]);
            }
        } catch (Exception $exception) {
            return response()->json(['success' => 'success']);
        }
        return response()->json(['success' => 'success']);
    }

    public function product(Request $request)
    {
        $data = DB::table('invoice_product')
            ->where('invoice_id', $request->product)
            ->distinct()
            ->get(['product_id']);
        return response()->json($data);

    }

    public function color(Request $request)
    {
        $data = DB::table('invoice_product')
            ->where('invoice_id', $request->color)
            ->where('product_id', $request->p)
            ->distinct()
            ->get(['color_id']);
        return response()->json($data);

    }

    public function manager(Request $request)
    {
        $date = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->statusu == 1) {
                Returns::where('id', $request->id_)
                    ->update([
                        'status' => 2,
                        'return_manager' => $request->statusu,
                    ]);
            } else {
                Returns::where('id', $request->id_)
                    ->update([
                        'status' => null,
                        'return_manager' => $request->statusu,
                    ]);
            }

            DB::table('return_manager')
                ->insert([
                    'user_id' => auth()->user()->id,
                    'return_id' => $request->id_,
                    'status' => $request->statusu,
                    'description' => $request->descriptionu,
                    'created_at' => $date,
                ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'success']);

    }

    public function print($id)
    {
        $date = Jalalian::forge(Carbon::now())->format('Y/m/d');
        $returns = DB::table('returns')->where('id', $id)->first();
        $customer_name = Customer::where('id', $returns->customer_id)->first();
        $detail_returns = DB::table('detail_returns')
            ->whereNull('state')
            ->where('return_id', $id)->first();
        $invoice_product = DB::table('invoice_product')
            ->where('invoice_id', $detail_returns->invoice_id)->first();
        $invoices_date = DB::table('schedulings')
            ->where('detail_id', $invoice_product->id)->first();
        $detail_return = DB::table('detail_returns')
            ->whereNull('state')
            ->where('return_id', $id)->get();
        $products = Product::all();
        $colors = Color::all();

        $manager = DB::table('return_manager')
            ->where('return_id', $id)
            ->latest()->first();
        if (!empty($manager)) {
            $sign = DB::table('users')->where('id', $manager->user_id)->first();
        } else {
            $sign = null;
        }


        $admin = DB::table('return_admin')
            ->where('return_id', $id)
            ->latest()->first();
        if (!empty($admin)) {
            $sign_ = DB::table('users')->where('id', $admin->user_id)->first();
        } else {
            $sign_ = null;
        }


        $barn_temporaries = DB::table('barn_temporaries')
            ->where('return_id', $id)
            ->get();


        $barn = DB::table('return_barn')
            ->where('return_id', $id)
            ->latest()->first();
        if (!empty($barn)) {
            $sign__ = DB::table('users')->where('id', $barn->user_id)->first();
        } else {
            $sign__ = null;
        }

        $qc = DB::table('return_qc')
            ->where('return_id', $id)
            ->latest()->first();
        if (!empty($qc)) {
            $sign___ = DB::table('users')->where('id', $qc->user_id)->first();
        } else {
            $sign___ = null;
        }


        return view('returns.detail', compact('id',
            'qc', 'barn', 'date', 'customer_name'
            , 'invoices_date', 'returns', 'detail_return', 'products', 'colors', 'sign'
            , 'sign_', 'barn_temporaries', 'sign__', 'sign___', 'admin'));
    }

    public function chat($id)
    {
        $data = DB::table('returns')
            ->where('id', $id)->first();
        $detail_returns = DB::table('detail_returns')
            ->whereNull('state')
            ->where('return_id', $data->id)->first();

        $invoice_id = DB::table('invoices')
            ->where('id', $detail_returns->invoice_id)->first();

        $user = User::where('id', $invoice_id->user_id)->first();

        $time = Jalalian::forge($data->created_at)->format('%A, %d %B %y');


        $return_managers = DB::table('return_manager')
            ->where('return_id', $id)->first();
        if (!empty($return_managers)) {
            $return_manager = DB::table('return_manager')
                ->where('return_id', $id)->latest()->first();
            $userr = User::where('id', $return_manager->user_id)->first();
            $timee = Jalalian::forge($return_manager->created_at)->format('%A, %d %B %y');
        } else {
            $return_manager = null;
            $userr = null;
            $timee = null;

        }
        $return_admins = DB::table('return_admin')
            ->where('return_id', $id)->first();
        if (!empty($return_admins)) {
            $return_admin = DB::table('return_admin')
                ->where('return_id', $id)->latest()->first();
            $userrr = User::where('id', $return_admin->user_id)->first();
            $timeee = Jalalian::forge($return_admin->created_at)->format('%A, %d %B %y');

        } else {
            $return_admin = null;
            $userrr = null;
            $timeee = null;

        }


        if (!empty($return_admins)) {
            $return_admina = DB::table('return_admin')
                ->where('return_id', $id)->latest()->first();
            $userrra = User::where('id', $return_admin->user_id)->first();
            $timeeea = Jalalian::forge($return_admin->created_at)->format('%A, %d %B %y');

        } else {
            $return_admina = null;
            $userrra = null;
            $timeeea = null;

        }


        $return_barns = DB::table('return_barn')
            ->where('return_id', $id)->first();
        if (!empty($return_barns)) {
            $return_barn = DB::table('return_barn')
                ->where('return_id', $id)->latest()->first();
            $userrrr = User::where('id', $return_barn->user_id)->first();
            $timeeee = Jalalian::forge($return_barn->created_at)->format('%A, %d %B %y');

        } else {
            $return_barn = null;
            $userrrr = null;
            $timeeee = null;

        }


        $return_qcs = DB::table('return_qc')
            ->where('return_id', $id)->first();
        if (!empty($return_qcs)) {
            $return_qc = DB::table('return_qc')
                ->where('return_id', $id)->latest()->first();
            $userrrrr = User::where('id', $return_qc->user_id)->first();
            $timeeeee = Jalalian::forge($return_qc->created_at)->format('%A, %d %B %y');

        } else {
            $return_qc = null;
            $userrrrr = null;
            $timeeeee = null;

        }


        return response()->json(['data' => $data, 'user' => $user, 'time' => $time
            , 'userr' => $userr, 'return_manager' => $return_manager
            , 'timee' => $timee, 'return_admin' => $return_admin, 'userrr' => $userrr
            , 'timeee' => $timeee, 'return_admina' => $return_admina, 'userrra' => $userrra
            , 'timeeea' => $timeeea
            , 'return_barn' => $return_barn, 'userrrr' => $userrrr
            , 'timeeee' => $timeeee, 'return_qc' => $return_qc, 'userrrrr' => $userrrrr
            , 'timeeeee' => $timeeeee

        ]);

    }

    public function update(Request $request)
    {
        $data = DB::table('returns')
            ->where('id', $request->id)->first();

        $detail = DB::table('detail_returns')
            ->whereNull('state')
            ->where('return_id', $request->id)->get();

        return response()->json(['data' => $data, 'detail_returns' => $detail]);

    }

    public function admiin(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('detail_returns')
                ->whereNull('state')
                ->where('return_id', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('invoices', function ($row) {
                    $invoices = DB::table('invoices')
                        ->where('id', $row->invoice_id)
                        ->first();
                    return $invoices->invoiceNumber;
                })
                ->addColumn('customer', function ($row) {
                    $invoices = DB::table('invoices')
                        ->where('id', $row->invoice_id)
                        ->first();
                    $customer = DB::table('customers')
                        ->where('id', $invoices->customer_id)
                        ->first();
                    return $customer->name;
                })
                ->addColumn('user', function ($row) {
                    $invoices = DB::table('invoices')
                        ->where('id', $row->invoice_id)
                        ->first();
                    $customer = DB::table('users')
                        ->where('id', $invoices->user_id)
                        ->first();
                    return $customer->name;
                })
                ->addColumn('product', function ($row) {
                    $invoices = DB::table('invoices')
                        ->where('id', $row->invoice_id)
                        ->first();
                    $customer = DB::table('invoice_product')
                        ->where('invoice_id', $invoices->id)
                        ->first();
                    $product = DB::table('products')
                        ->where('id', $customer->product_id)->first();
                    return $product->label;
                })
                ->addColumn('product', function ($row) {
                    $product = DB::table('products')
                        ->where('id', $row->product_id)->first();
                    return $product->label;
                })
                ->addColumn('color', function ($row) {
                    $product = DB::table('colors')
                        ->where('id', $row->color_id)->first();
                    return $product->name;
                })
                ->addColumn('date', function ($row) {
                    $returns = DB::table('returns')
                        ->where('id', $row->return_id)->first();
                    return $returns->date;
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('returns.list');


    }

    public function success(Request $request)
    {
        $date = Carbon::now();
        $carbon = Carbon::now();
        $has = DB::table('barn_temporaries')
            ->where('return_id', $request->id_d)
            ->first();
        DB::table('return_barn')
            ->insert([
                'user_id' => auth()->user()->id,
                'return_id' => $request->id_d,
                'status' => $request->statusd,
                'description' => $request->descriptiond,
                'created_at' => $carbon,
            ]);
        if ($request->statusd == 1) {
            Returns::where('id', $request->id_d)
                ->update([
                    'status' => 4,
                    'return_barn' => $request->statusd,
                ]);
            if (!empty($has)) {
                DB::table('barn_temporaries')
                    ->where('return_id', $request->id_d)
                    ->delete();
            }
            try {
                $m = count(collect($request)->get('number'));
                for ($i = 0; $i < $m; $i++) {
                    DB::table('barn_temporaries')
                        ->insert([
                            'user_id' => auth()->user()->id,
                            'return_id' => $request->id_d,
                            'product_id' => $request->get('product')[$i],
                            'color_id' => $request->get('coloor')[$i],
                            'number' => abs($request->get('number')[$i]),
                            'date' => Jalalian::forge($carbon)->format('Y/m/d'),
                            'created_at' => $carbon,
                        ]);
                }
            } catch (Exception $exception) {
                $m = count(collect($request)->get('number'));
                for ($i = 0; $i < $m; $i++) {
                    DB::table('barn_temporaries')
                        ->insert([
                            'user_id' => auth()->user()->id,
                            'return_id' => $request->id_d,
                            'product_id' => $request->get('product')[$i],
                            'color_id' => $request->get('coloor')[$i],
                            'number' => abs($request->get('number')[$i]),
                            'date' => Jalalian::forge($carbon)->format('Y/m/d'),
                        ]);
                }
            }
        } else {
            Returns::where('id', $request->id_d)
                ->update([
                    'status' => 1,
                    'return_barn' => null,
                    'return_admin' => null,
                    'return_manager' => null,
                ]);
        }
        return response()->json(['success' => 'success']);
    }

    public function storee(Request $request)
    {
        DB::beginTransaction();
        try {
            $return = Returns::create([
                'user_id' => auth()->user()->id,
                'customer_id' => $request->customer_id,
                'Cost' => $request->Carry,
                'date' => $request->date,
                'Description_m' => $request->description_m,
                'Description_v' => $request->description_f,
                'description' => $request->description,
                'status' => 1,
            ]);
            try {
                $invoice = count(collect($request)->get('product'));
                for ($i = 0; $i < $invoice; $i++) {
                    \DB::table('detail_returns')->insert([
                        'return_id' => $return->id,
                        'invoice_id' => $request->get('invoice')[$i],
                        'product_id' => $request->get('product')[$i],
                        'color_id' => $request->get('color')[$i],
                        'number' => $request->get('number')[$i],
                        'reason' => $request->get('reasons')[$i],
                    ]);
                }
            } catch (Exception $exception) {
                return response()->json(['success' => 'success']);
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'success']);
    }

    public function sttoree(Request $request)
    {

        DB::beginTransaction();
        try {
            $return = Returns::create([
                'customer_id' => $request->customer_id,
                'Cost' => $request->Carry,
                'date' => $request->dattee,
                'Description_m' => $request->description_m,
                'Description_v' => $request->description_f,
                'description' => $request->description,
                'status' => 1,
            ]);
            DB::table('detail_returns')
                ->where('complaints_id', $request->id_id)
                ->update([
                    'return_id' => $return->id,
                ]);
            Complaints::where('id', $request->id_id)
                ->update([
                    'status' => 3,
                ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'success']);
    }

    public function totalnumber(Request $request)
    {
        $data = DB::table('invoice_product')
            ->where('invoice_id', $request->color)
            ->where('product_id', $request->p)
            ->where('color_id', $request->c)
            ->first();
        return response()->json($data);

    }

    public function qr(Request $request)
    {

        $print = $request->print;
        $returns = DB::table('returns')
            ->where('id', $request->id)->first();
        $name = Customer::where('id', $returns->customer_id)->first();
        $merge = 'R' . $request->id . ' - ' . $name->name;
        $a = DNS2D::getBarcodePNGPath($merge, 'QRCODE');
        $view = \View::make('returns.qr', compact('a', 'returns', 'print'));
        return $view->render();
    }

    public function storeinvoice(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'Weight.*' => 'required|integer',
            'number.*' => 'required',
            'sell.*' => 'required',
            'color.*' => 'required',
            'product.*' => 'required',
        ], [
            'number.*.required' => 'لطفا تعداد فروش محصول را مشخص کنید',
            'product.*.required' => 'لطفا محصول خود را انتخاب کنید',
            'color.*.required' => 'لطفا رنگ محصول را انتخاب کنید',
            'sell.*.required' => 'لطفا قیمت فروش محصول را مشخص کنید',
            'Weight.*.required' => 'لطفا وزن محصول را وارد کنید برای اینکار به تعاریف پایه مراجعه کنید',
            'Weight.*.integer' => 'لطفا وزن محصول را وارد کنید برای اینکار به تعاریف پایه مراجعه کنید',
        ]);
        $tx = (int)$request->price_full - (int)$request->price_selll;
        if ($tx < 0) {
            $tax = 0;
        } else {
            $tax = $tx;
        }
        $date = Jalalian::forge(date('Y/m/d'))->format('Y/m/d');
        $to = Carbon::parse($date);
        $now_date = new Verta();
        $year = substr($now_date->year, strpos($now_date->year, '://') + 2, 6);
        $rand = Invoice::withTrashed()->latest('id')->first();
        if ($rand == null) {
            $numberCount = 100000;
        } else {
            $numberCount = $rand->number + 1;
        }
        $invoiceNumber = $year . $numberCount;
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $invoice = Invoice::create([
                    'invoiceNumber' => $invoiceNumber,
                    'number' => $numberCount,
                    'user_id' => $request->user_id,
                    'customer_id' => $request->customer_id,
                    'invoiceType' => $request->InvoiceType,
                    'paymentMethod' => $request->paymentMethod,
                    'sum_sell' => $request->sum_selll,
                    'number_sell' => $request->number_selll,
                    'price_sell' => $request->price_selll,
                    'created' => date("Y/m/d"),
                    'date' => $date,
                    'tax' => $tax,
                    'Month' => $to->month,
                    'Year' => $to->year,
                    'takhfif' => $request->takhfif,
                    'expenses' => $request->expenses,
                    'Carry' => $request->Carry,
                    'ta' => $request->taa,
                    'totalfinal' => $request->price_f,
                    'ma' => $request->ma,
                    'create' => $this->convert2english($request->created),
                    'returns' => $request->return,
                    'description' => $request->description,
                ]);
                try {
                    $number = count(collect($request)->get('product'));
                    for ($i = 0; $i <= $number; $i++) {
                        \DB::table('invoice_product')->insert([
                            'invoice_id' => $invoice->id,
                            'user_id' => $request->user_id,
                            'product_id' => $request->get('product')[$i],
                            'color_id' => $request->get('color')[$i],
                            'salesNumber' => $request->get('number')[$i],
                            'leftover' => $request->get('number')[$i],
                            'salesPrice' => $request->get('sell')[$i],
                            'sumTotal' => $request->get('Price_Sell')[$i],
                            'weight' => $request->get('Weight')[$i],
                            'taxAmount' => $request->get('Tax')[$i],
                        ]);
                    }
                } catch (\Exception $e) {
                }
                DB::commit();
            } catch (Exception $exception) {
                DB::rollBack();
            }
            return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function actions($row)
    {
        $btn = null;
        if ($row->status != 9) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="مدیر فروش"
                       class="chast">
                       <i class="fa fa-comment fa-lg" title="سابقه گفتگو"></i>
                       </a>&nbsp;&nbsp;';
            if ($row->status == 7) {
                $btn = $btn . '<a href="' . route('admin.invoice.store.return', $row->id) . '">
                       <i class="fa fa-mail-reply-all fa-lg" title="صدور پیش فاکتور"></i>
                       </a>&nbsp;&nbsp;';
            }
            if ($row->status == 1 and $row->return_manager == null) {
                if (Gate::check('نظر مدیر فروش')) {
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="مدیر فروش"
                       class="usert">
                       <i class="fa fa-user fa-lg" title="مدیر فروش"></i>
                       </a>&nbsp;&nbsp;';
                }
            }
            if ($row->status == null) {
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="مدیر فروش"
                       class="editt">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="مدیر فروش"
                       class="deletereturns">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>&nbsp;&nbsp;';

            }
            if ($row->status == 2) {

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نظر مدیر عامل"
                       class="admi">
                       <i class="fa fa-user-plus fa-lg" title="نظر مدیر عامل"></i>
                       </a>&nbsp;&nbsp;';

            }
            if ($row->status == 5) {

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نظر نهایی مدیر عامل"
                       class="admiinc">
                       <i class="fa fa-user-md fa-lg" title="نظر نهایی مدیر عامل"></i>
                       </a>&nbsp;&nbsp;';

            }
            if ($row->status == 4) {


                if (Gate::check('نظر QC')) {
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="درخواست مرجوعی"
                       class="qc">
                       <i class="fa fa-file-text fa-lg" title="نظر QC"></i>
                       </a>&nbsp;&nbsp;';
                }
            }
            if ($row->status != 1 and $row->status != 2 and $row->status != 3) {

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="درخواست مرجوعی"
                       class="qr">
                       <i class="fa fa-barcode fa-lg" title="چاپ QR"></i>
                       </a>&nbsp;&nbsp;';

            }
            if ($row->status == 3) {
                if (Gate::check('نظر انبار')) {
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نظر انبار"
                       class="database">
                       <i class="fa fa-database fa-lg" title="نظر انبار"></i>
                       </a>&nbsp;&nbsp;';
                }
            }
        }


        return $btn;

    }

    public function action($row)
    {
        if (empty($row->end)) {
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش"
                       class="end">
                        <i class="fa fa-check fa-lg" title="تایید حواله برای خروج"></i>
                       </a>&nbsp;&nbsp;';
        } else {
            $btn = null;
        }

        return $btn;
    }

    public function convert2english($string)
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
