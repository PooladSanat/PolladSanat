<?php

namespace App\Http\Controllers\Payment;

use App\Color;
use App\Customer;
use App\CustomerAccount;
use App\Factors;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Payments;
use App\Product;
use App\User;
use Cache;
use Carbon\Carbon;
use DB;
use Hekmatinasser\Verta\Verta;
use http\Env\Response;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Promise\all;

class PaymentsController extends Controller
{

    public function list(Request $request)
    {
        $array_customer = array();
        $array_user = array();
        $v = verta();
        $customers = Customer::all();
        $users = User::all();
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        foreach ($users as $u) {
            $array_user[] = $u->id;
        }
        if ($request->ajax()) {

//            $data = DB::select("CALL get_invoices()");
            if ($request->customer_id == 0) {
                $customer = $array_customer;
            } else {
                $customer = [$request->customer_id];
            }
            if ($request->user_id == 0) {
                $user = $array_user;
            } else {
                $user = [$request->user_id];
            }
            if (!empty($request->indate)) {
                $indate = $request->indate;
            } else {
                $indate = "1370/04/10";
            }
            if (!empty($request->todate)) {
                $todate = $request->todate;
            } else {
                $todate = "1470/04/10";
            }

            $data = DB::table('View_Factors')
                ->where('status', 0)
                ->where('end', null)
                ->whereIn('customer_id', $customer)
                ->whereIn('user_id', $user)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('date', 'DESC')
                ->orderBy('customer_id', 'desc')
                ->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $btn = null;
                    if ($row->sort == null) {
                        $btn = ' <input type="checkbox" id="checkbox"
                        name="student_checkbox[]"
                        value=' . $row->pack_id . '
                       class="student_checkbox">';
                    } else {
                        $btn = null;
                    }
                    return $btn;

                })
                ->addColumn('total', function ($row) {
                    return number_format($row->sum);
                })
                ->addColumn('pack_id', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack_id . '" data-original-title="ویرایش"
                       class="detail-factor">
                      ' . $row->pack_id . '
                       </a>';
                    return $btn;

                })
                ->addColumn('havale', function ($row) {
                    if (!empty($row->havale)) {
                        return $row->havale;
                    } else {
                        return 'شماره حواله ثبت نشده است';
                    }

                })
                ->addColumn('rahkaran', function ($row) {
                    if (!empty($row->rahkaran)) {
                        return $row->rahkaran;
                    } else {
                        return 'شماره فاکتور ثبت نشده است';
                    }


                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'checkbox', 'pack_id'])
                ->make(true);
        }
        return view('payment.list', compact('customers', 'users'));
    }

    public function ListList(Request $request)
    {
        if ($request->ajax()) {
            $pack = array();
            $clearing_factor = DB::table('clearing_factor')
                ->where('clearing_id', $request->detail_factor)
                ->get();
            foreach ($clearing_factor as $item)
                $pack[] = $item->pack_id;

            $data = DB::table('schedulings')
                ->whereIn('pack', $pack)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش"
                       class="detail-factor-product">
                      ' . $row->pack . '
                       </a>';
                    return $btn;
                })
                ->addColumn('sort', function ($row) use ($request) {
                    return $request->detail_factor;
                })
                ->addColumn('product', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $product = Product::where('id', $detail->product_id)
                        ->first();
                    return $product->label;
                })
                ->addColumn('ta', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $product = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    return number_format($product->ta);
                })
                ->addColumn('color', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $color = Color::where('id', $detail->color_id)
                        ->first();
                    return $color->name;
                })
                ->addColumn('customer', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $customer = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    $name = User::where('id', $customer->user_id)->first();
                    return $name->name;
                })
                ->addColumn('user', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $customer = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    $name = Customer::where('id', $customer->customer_id)->first();
                    return $name->name;

                })
                ->addColumn('total', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    return $detail->salesNumber;
                })
                ->addColumn('factor', function ($row) {
                    $detail = DB::table('factors')
                        ->where('pack_id', $row->pack)
                        ->first();
                    return number_format($detail->sum);
                })
                ->addColumn('type', function ($row) {
                    $detail = DB::table('factors')
                        ->where('pack_id', $row->pack)
                        ->first();
                    return $detail->type;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['id'])
                ->make(true);
        }

        return view('bills.list');

    }

    public function ListListpack(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('View_Scheduling')
                ->where('pack', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
//                ->addColumn('product', function ($row) {
//                    $detail = DB::table('invoice_product')
//                        ->whe re('id', $row->detail_id)
//                        ->first();
//                    $product = Product::where('id', $detail->product_id)
//                        ->first();
//                    return $product->label;
//                })
                ->rawColumns([])
                ->make(true);
        }
        return view('bills.list');
    }

    public function ListListPayment(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('schedulings')
                ->where('pack', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $product = Product::where('id', $detail->product_id)
                        ->first();
                    return $product->label;
                })
                ->addColumn('color', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $color = Color::where('id', $detail->color_id)
                        ->first();
                    return $color->name;
                })
                ->addColumn('customer', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $customer = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    $name = User::where('id', $customer->user_id)->first();
                    return $name->name;
                })
                ->addColumn('user', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $customer = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    $name = Customer::where('id', $customer->customer_id)->first();
                    return $name->name;

                })
                ->addColumn('total', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    return $detail->salesNumber;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('ExitReport.list');
    }

    public function detaillist(Request $request)
    {
        $array_customer = array();
        $v = verta();
        $customers = Customer::all();
        $users = User::all();
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        foreach ($users as $u) {
            $array_user[] = $u->id;
        }
        if ($request->ajax()) {
//            $data = DB::select("CALL get_invoices()");
            if ($request->customer_id == 0) {
                $customer = $array_customer;
            } else {
                $customer = [$request->customer_id];
            }
            if ($request->user_id == 0) {
                $user = $array_user;
            } else {
                $user = [$request->user_id];
            }
            if (!empty($request->indate)) {
                $indate = $request->indate;
            } else {
                $indate = "1370/04/10";
            }
            if (!empty($request->todate)) {
                $todate = $request->todate;
            } else {
                $todate = "1470/04/10";
            }


            $data = DB::table('View_Factors')
                ->where('status', 1)
                ->whereIn('customer_id', $customer)
                ->whereIn('user_id', $user)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('date', 'DESC')
                ->orderBy('customer_id', 'desc')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $btn = ' <input type="checkbox" id="checkbox"
                        name="student_checkbox[]"
                        value=' . $row->pack_id . '
                       class="student_checkbox">';
                    return $btn;
                })
                ->addColumn('total', function ($row) {
                    return number_format($row->sum);
                })
                ->addColumn('sumtotal', function ($row) {
                    $number = Factors::where('customer_id', $row->customer_id)
                        ->sum('sum');
                    return number_format($number);
                })
                ->addColumn('pack_id', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack_id . '" data-original-title="ویرایش"
                       class="detail-factor">
                      ' . $row->pack_id . '
                       </a>';
                    return $btn;

                })
                ->addColumn('havale', function ($row) {
                    if (!empty($row->havale)) {
                        return $row->havale;
                    } else {
                        return 'شماره حواله ثبت نشده است';
                    }

                })
                ->addColumn('rahkaran', function ($row) {
                    if (!empty($row->rahkaran)) {
                        return $row->rahkaran;
                    } else {
                        return 'شماره فاکتور ثبت نشده است';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'checkbox', 'pack_id'])
                ->make(true);
        }
        return view('payment.detaillist', compact('customers', 'users'));
    }

    public function paymentsuccess(Request $request)
    {
        $array_customer = array();
        $v = verta();
        $customers = Customer::all();
        $array_Year = [1399, 1400, 1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409, 1410, 1411, 1412, 1413, 1414, 1415, 1416, 1417, 1418, 1419, 1420];
        $array_month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        if ($request->ajax()) {
//            $data = DB::select("CALL get_invoices()");

            if ($request->customer_id == null) {
                $customer = $array_customer;
            } else {
                $customer = [$request->customer_id];
            }
            if ($request->year == null) {
                $year = $array_Year;
            } else {
                $year = [$request->year];
            }
            if ($request->month == null) {
                $month = $array_month;
            } else {
                $month = [$request->month];
            }

            $data = DB::table('factors')
                ->where('Month', $v->month)
                ->where('status', 1)
                ->whereIn('customer_id', $customer)
                ->whereIn('Year', $year)
                ->whereIn('Month', $month)
                ->orderBy('customer_id', 'asc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('total', function ($row) {
                    return number_format($row->sum);
                })
                ->addColumn('number', function ($row) {
                    $number = Factors::where('customer_id', $row->customer_id)
                        ->count();
                    return $number;
                })
                ->addColumn('sumtotal', function ($row) {
                    $number = Factors::where('customer_id', $row->customer_id)
                        ->sum('sum');
                    return number_format($number);
                })
                ->addColumn('creditor', function ($row) {
                    $number = CustomerAccount::where('customer_id', $row->customer_id)
                        ->first();
                    if (!empty($number)) {
                        return number_format($number->creditor);

                    } else {
                        return number_format(0);

                    }
                })
                ->addColumn('customer', function ($row) {
                    $customer = Customer::where('id', $row->customer_id)->first();
                    return $customer->name;
                })
                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('paymentsuccess.list', compact('customers'));
    }

    public function listdetail(Request $request)
    {


        if ($request->ajax()) {
            $data = DB::table('detail_customer_payment')
                ->where('payment_id', $request->id_id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    if ($row->type == 1) {
                        return 'نقدی';
                    } else {
                        return 'چکی';
                    }
                })
                ->addColumn('sort', function ($row) use ($request) {
                    return $request->id_id;
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('actioon', function ($row) {
                    return $this->actionss($row);
                })
                ->rawColumns(['actioon'])
                ->make(true);
        }

        return view('payment.list');

    }

    public function payment(Request $request)
    {
        $check_customer_id = array();
        $check_price = array();
        $count = count($request->id);
        for ($i = 0; $i < $count; $i++) {
            try {
                $customer = DB::table('factors')
                    ->where('pack_id', $request->id[$i])
                    ->first();
                $check_customer_id[] = $customer->customer_id;
                $check_price[] = $customer->sum;
            } catch (Exception $exception) {
            }
        }
        $price = array_sum($check_price);
        $min = min($check_customer_id);
        $max = max($check_customer_id);
        if ($min != $max) {
            return response()->json(['error_customer' => 'error_customer']);
        }
        $customer_account = CustomerAccount::
        where('customer_id', $check_customer_id[0])
            ->first();
        if (empty($customer_account)) {
            $custome = null;
        } else {
            $custome = $customer_account;
        }

        return response()->json(['success' => 'success',
            'name_cusomer' => $check_customer_id[0], 'price' => $price
            , 'creditor' => $custome,
            'customer_id' => $check_customer_id[0], 'pack_id' => $request->id]);

    }

    public function storepament(Request $request)
    {

        $string = preg_split("/,+/", "$request->pack_id");
        $count = count($string);
        $date = Carbon::now();
        DB::beginTransaction();
        try {
            DB::table('clearing')->insert([
                'date' => Jalalian::forge($date)->format('Y/m/d'),
                'takhfif' => $request->takhfif,
                'price' => $request->sum,
                'status' => 0,
                'customer_id' => $request->name_cusomer,
            ]);

            $id = DB::table('clearing')
                ->latest('id')->first();
            for ($i = 0; $i < $count; $i++) {
                try {
                    DB::table('clearing_factor')->insert([
                        'clearing_id' => $id->id,
                        'pack_id' => $string[$i],
                    ]);
                    DB::table('factors')
                        ->where('pack_id', $string[$i])
                        ->update([
                            'sort' => 1,
                        ]);
                } catch (Exception $exception) {
                }
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        $user = DB::table('factors')
            ->where('pack_id', $string[0])
            ->first();
        $user_id = User::where('id', $user->user_id)->first();
        $CustomerAccount = DB::table('customer_accounts')->
        where('customer_id', $request->customer_idd)
            ->first();
        if (!empty($CustomerAccount)) {
            $customeraccount = $CustomerAccount->creditor;
        } else {
            $customeraccount = 0;
        }
        $price_customer = DB::table('detail_customer_payment')
            ->where('customer_id', $request->customer_idd)
            ->sum('price');
        $customer_name = Customer::where('id', $request->customer_idd)
            ->first();
        $factors = DB::table('factors')
            ->whereIn('pack_id', $string)
            ->get();
        $sum_price = $request->sum_price;
        $takhfif = $request->takhfif;
        $final = $request->sum_price - $request->takhfif;
        $view = \View::make('payment.print', compact('user_id', 'customer_name', 'customeraccount', 'price_customer', 'factors', 'sum_price', 'takhfif', 'final'));
        return $view->render();
//        if ($request->sum > $request->creditor) {
//            return response()->json(['error_creditor' => 'error_creditor']);
//        }
//        $string = preg_split("/,+/", "$request->pack_id");
//        $created_at = Carbon::now();
//        DB::beginTransaction();
//        try {
//            DB::table('payments_success')
//                ->insert([
//                    'pack_id' => json_encode($request->pack_id),
//                    'user_id' => auth()->user()->id,
//                    'customer_id' => $request->customer_idd,
//                    'ta' => $request->takhfif,
//                    'created_at' => $created_at,
//                ]);
//
//            $count = count($string);
//            for ($i = 0; $i < $count; $i++) {
//                try {
//                    DB::table('factors')
//                        ->where('pack_id', $string[$i])
//                        ->update([
//                            'status' => 1,
//                        ]);
//                } catch (Exception $exception) {
//                }
//            }
//
//            CustomerAccount::where('customer_id', $request->customer_idd)
//                ->update([
//                    'creditor' => $request->creditor - $request->sum,
//                ]);
//            DB::commit();
//        } catch (Exception $exception) {
//            DB::rollBack();
//        }
//        return response()->json(['success' => 'success']);

    }

    public function store(Request $request)
    {
        $sql = DB::insert('CALL InsertPayment (?)', array('nima'));
        dd($sql);
    }

    public function factor(Request $request)
    {
        $id = DB::table('factors')
            ->where('id', $request->id_factor)
            ->first();
        $pack_id = "$id->pack_id";
        $CustomerAccount = CustomerAccount::where('customer_id', $id->customer_id)->first();
        DB::beginTransaction();
        try {
            CustomerAccount::where('customer_id', $id->customer_id)
                ->update([
                    'creditor' => $CustomerAccount->creditor + $id->sum,
                ]);
            DB::table('factors')
                ->where('id', $request->id_factor)
                ->update([
                    'status' => 0,
                    'canceled' => 1,
                    'description' => $request->description,
                ]);

            DB::table('payments_success')
                ->where('pack_id', $pack_id)
                ->update([
                    'pack_id' => 0,
                ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }


        return response()->json(['success' => 'success']);

    }

    public function update($id)
    {
        $pack = array();

        $pack_iidd = \DB::table('clearing_factor')
            ->where('clearing_id', $id)
            ->first();
        $pack_isdd = \DB::table('clearing_factor')
            ->where('clearing_id', $id)
            ->get();
        foreach ($pack_isdd as $item) {
            $pack[] = $item->pack_id;
        }

        $idd = \DB::table('factors')
            ->where('pack_id', $pack_iidd->pack_id)
            ->first();
        $name_custome = $idd->customer_id;
        $detais = DB::table('clearing_factor')
            ->where('clearing_id', $id)
            ->first();

        $detail_id = DB::table('factors')
            ->where('pack_id', $detais->pack_id)
            ->first();

        $clearing = DB::table('clearing')
            ->where('id', $id)
            ->first();

        if (!empty($clearing)) {
            $p = number_format($clearing->price);
            $pp = $clearing->price;
        } else {
            $p = number_format(0);
            $pp = 0;
        }

        $name = Customer::where('id', $detail_id->customer_id)->first();
        $date = DB::table('detail_customer_payment')
            ->where('customer_id', $detail_id->customer_id)
            ->latest()->first();
        if (!empty($date)) {
            $dat = Jalalian::forge($date->created_at)->format('در تاریخ ' . 'Y/m/d' . '  ساعت ' . 'H:i:s');
        } else {
            $dat = null;
        }
        $price = CustomerAccount::where('customer_id', $detail_id->customer_id)->first();
        if (!empty($price)) {
            $pri = number_format($price->creditor);
            $prii = $price->creditor;
        } else {
            $pri = number_format(0);
            $prii = 0;
        }
        return response()->json([
            'name_customer' => $name_custome, 'name' => $name,
            'price' => $pri, 'pricee' => $prii, 'date' => $dat, 'sum' => $p,
            'summ' => $pp, 'pack' => $pack]);

    }

    public function StoreAdmin(Request $request)
    {

        $account = DB::table('customer_accounts')
            ->where('customer_id', $request->cid)
            ->first();
        $packs = array();
        $details = \DB::table('clearing_factor')
            ->where('clearing_id', $request->customer_iderr)
            ->get();
        foreach ($details as $detail)
            $packs[] = $detail->pack_id;
        $payment = $request->pricessummm - $request->detail_customersa;
        DB::table('admin_customer')
            ->insert([
                'clearing_id' => $request->customer_iderr,
                'status' => $request->status,
                'description' => $request->description_admin,
            ]);
        if ($request->status == 1) {

            DB::table('customer_accounts')
                ->where('customer_id', $request->cid)
                ->update([
                    'creditor' => $account->creditor - $request->pricesummm,
                ]);

            DB::table('clearing')
                ->where('id', $request->customer_iderr)
                ->update([
                    'status' => 1,
                ]);
            \DB::table('factors')
                ->whereIn('pack_id', $packs)
                ->update([
                    'status' => 1,
                    'payment' => 1,
                    'end' => 1,
                ]);
            return \response()->json(['success' => 'success']);
        } else {
            $customre = DB::table('customer_accounts')
                ->where('customer_id', $request->cid)
                ->first();
            DB::table('customer_accounts')
                ->where('customer_id', $request->cid)
                ->update([
                    'creditor' => $request->detail_customersa + $customre->creditor + $payment,
                ]);
            DB::table('clearing')
                ->where('id', $request->customer_iderr)
                ->update([
                    'status' => 0,
                ]);
            return \response()->json(['success' => 'success']);
        }


    }

    public function updatee($id)
    {


        $detail_customer_payment = DB::table('detail_customer_payment')
            ->where('payment_id', $id)
            ->sum('price');

        if (!empty($detail_customer_payment)) {
            $detail_customer = number_format($detail_customer_payment);
            $detail_customersa = $detail_customer_payment;
        } else {
            $detail_customer = 0;
            $detail_customersa = 0;
        }

        $detais = DB::table('clearing_factor')
            ->where('clearing_id', $id)
            ->first();

        $detail_id = DB::table('factors')
            ->where('pack_id', $detais->pack_id)
            ->first();

        $clearing = DB::table('clearing')
            ->where('id', $id)
            ->first();

        if (!empty($clearing)) {
            $p = number_format($clearing->price);
            $pp = $clearing->price;
        } else {
            $p = number_format(0);
            $pp = 0;
        }

        $recive_customers = $pp - $detail_customersa;
        $recive_customer_payment = number_format($recive_customers);

        $name = Customer::where('id', $detail_id->customer_id)->first();
        $date = DB::table('detail_customer_payment')
            ->where('customer_id', $detail_id->customer_id)
            ->latest()->first();
        if (!empty($date)) {
            $dat = Jalalian::forge($date->created_at)->format('در تاریخ ' . 'Y/m/d' . '  ساعت ' . 'H:i:s');
        } else {
            $dat = null;
        }
        $price = CustomerAccount::where('customer_id', $detail_id->customer_id)->first();
        if (!empty($price)) {
            $pri = number_format($price->creditor);
            $prii = $price->creditor;
        } else {
            $pri = number_format(0);
            $prii = 0;
        }

        $baghi = number_format($prii - $detail_customersa);
        $baghii = $prii - $detail_customersa;

        $detail_customer_payment_sum = DB::table('detail_customer_payment')
            ->where('customer_id', $detail_id->customer_id)
            ->where('payment_id', '!=', $id)
            ->sum('price');
        $detail_customer_payment_summ = number_format($detail_customer_payment_sum);


        $payment_customer = DB::table('detail_customer_payment')
            ->where('customer_id', $detail_id->customer_id)
            ->sum('price');

        if (!empty($payment_customer)) {
            $customer_payment = number_format($payment_customer);
        } else {
            $customer_payment = 0;
        }


        $factor_customer = DB::table('factors')
            ->where('customer_id', $detail_id->customer_id)
            ->count();

        $final = $baghii + $detail_customersa - $pp;
        $fina = number_format(abs($final));


        return response()->json(['recive_customer' => $recive_customer_payment,
            'clearing' => $clearing,
            'detail_customer' => $detail_customer, 'name' => $name, 'baghi' => $baghi,
            'price' => $pri, 'pricee' => $prii, 'date' => $dat, 'final' => $fina,
            'detail_customer_payment_sum' => $detail_customer_payment_summ,
            'sum' => $p, 'summ' => $pp, 'factor_customer' => $factor_customer,
            'customer_payment' => $customer_payment, 'detail_customersa' => $detail_customersa]);

    }

    public function trash($id)
    {
        $detail = DB::table('detail_customer_payment')
            ->where('id', $id)
            ->first();
        $customer = DB::table('customer_accounts')
            ->where('customer_id', $detail->customer_id)
            ->first();
        DB::table('customer_accounts')
            ->where('customer_id', $detail->customer_id)
            ->update([
                'creditor' => $customer->creditor - $detail->price,
            ]);
        $detail = DB::table('detail_customer_payment')
            ->where('id', $id)
            ->delete();


        return \response()->json($detail);

    }

    public function edit($id)
    {
        $detail = DB::table('detail_customer_payment')
            ->where('id', $id)
            ->first();
        return \response()->json($detail);

    }

    public function statussort(Request $request)
    {
        $dataa = \DB::table('clearing')
            ->where('id', $request->detail_factor)
            ->first();

        if ($request->ajax()) {

            $data = \DB::table('clearing')
                ->where('customer_id', $dataa->customer_id)
                ->where('id', "!=", $request->detail_factor)
                ->orderBy('date', 'desc')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('payment', function ($row) use ($request) {
                    $detail_customer_payment = DB::table('detail_customer_payment')
                        ->where('payment_id', $row->id)
                        ->sum('price');
                    return number_format($detail_customer_payment);
                })
                ->addColumn('s', function ($row) use ($request) {
                    $detail_customer_payment = DB::table('detail_customer_payment')
                        ->where('payment_id', $row->id)
                        ->sum('price');
                    return $detail_customer_payment - $row->price;
                })
                ->addColumn('ss', function ($row) use ($request) {
                    $detail_customer_payment = DB::table('detail_customer_payment')
                        ->where('payment_id', $row->id)
                        ->sum('price');
                    $t = abs($detail_customer_payment - $row->price);
                    return number_format($t);
                })


                ->addColumn('a', function ($row) use ($dataa,$request) {
                    $clearing = \DB::table('clearing')
                        ->where('customer_id', $dataa->customer_id)
                        ->where('id', "!=", $request->detail_factor)
                        ->sum('price');
                    return $clearing;
                })
                ->addColumn('b', function ($row) use ($dataa,$request) {
                    $clearing = \DB::table('detail_customer_payment')
                        ->where('customer_id', $dataa->customer_id)
                        ->where('payment_id', "!=", $request->detail_factor)
                        ->sum('price');
                    return $clearing;
                })

                ->addColumn('sort', function ($row) use ($dataa,$request) {
                    $factor = \DB::table('factors')
                        ->where('customer_id', $dataa->customer_id)
                        ->whereNull("sort")
                        ->sum('sum');
                    return $factor;
                })

                ->rawColumns([''])
                ->make(true);
        }

        return view('bills.list');

    }

    public function ListListDetail(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('schedulings')
                ->where('pack', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->pack;
                })
                ->addColumn('product', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $product = Product::where('id', $detail->product_id)
                        ->first();
                    return $product->label;
                })
                ->addColumn('color', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $color = Color::where('id', $detail->color_id)
                        ->first();
                    return $color->name;
                })
                ->addColumn('customer', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $customer = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    $name = User::where('id', $customer->user_id)->first();
                    return $name->name;
                })
                ->addColumn('user', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $customer = Invoice::where('id', $detail->invoice_id)
                        ->first();
                    $name = Customer::where('id', $customer->customer_id)->first();
                    return $name->name;

                })
                ->addColumn('total', function ($row) {
                    $detail = DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    return $detail->salesNumber;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns([])
                ->make(true);
        }

        return view('bills.list');

    }

    public function EditUpdate(Request $request)
    {
        $detail = DB::table('detail_customer_payment')
            ->where('id', $request->id_detail)
            ->first();
        $customer = DB::table('customer_accounts')
            ->where('customer_id', $detail->customer_id)
            ->first();
        DB::table('customer_accounts')
            ->where('customer_id', $detail->customer_id)
            ->update([
                'creditor' => $customer->creditor - $detail->price + $request->prricee,
            ]);
        DB::table('detail_customer_payment')
            ->where('id', $request->id_detail)
            ->update([
                'type' => $request->tyypee,
                'shenase' => $request->shenasee,
                'date' => $request->daatee,
                'name' => $request->naamee,
                'name_user' => $request->name_userr,
                'price' => $request->prricee,
                'descriptionn' => $request->descriptionnnmnmn,
            ]);
        return \response()->json(['success' => 'success']);

    }

    public function actions($row)
    {


        $btn = '<a href="' . route('admin.Scheduling.print', $row->pack_id) . '" target="_blank">
                       <i class="fa fa-print fa-lg" title="چاپ فاکتور فروش"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;

    }

    public function actionss($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="detail-edit">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="detail-trash">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;

    }

    public function action($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف فاکتور"
                       class="detail-trash">
                       <i class="fa fa-trash fa-lg" title="حذف فاکتور"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;

    }

}
