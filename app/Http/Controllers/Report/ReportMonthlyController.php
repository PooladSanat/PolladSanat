<?php

namespace App\Http\Controllers\Report;

use App\Color;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Product;
use App\Scheduling;
use App\User;
use Cache;
use Carbon\Carbon;
use DB;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class ReportMonthlyController extends Controller
{
    public function list(Request $request)
    {
        if (!empty($request->indate)) {
            $in = $request->indate;
        } else {
            $in = "1399/05/01";
        }
        if (!empty($request->todate)) {
            $to = $request->todate;
        } else {
            $to = "1399/05/31";
        }
        $v = Verta::parse($in);
        $vv = Verta::parse($to);
        $iny = $v->year;
        $inm = $v->month;
        $ind = $v->day;
        $inyy = $vv->year;
        $inmm = $vv->month;
        $indd = $vv->day;
        $y = Verta::getGregorian($iny, $inm, $ind);
        $innn = $y[0] . "/" . $y[1] . '/' . $y[2];
        $yy = Verta::getGregorian($inyy, $inmm, $indd);
        $innnn = $yy[0] . "/" . $yy[1] . '/' . $yy[2];


        if ($request->ajax()) {
            $data = $this->displayDates($innn, $innnn);


//            $data = \DB::table('view_unionreportmontly')
//                ->whereBetween('date', array($indate, $todate))
//                ->distinct()
//                ->orderBy('date', 'ASC')
//                ->get(['date']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $rew = Jalalian::forge($row)->format('Y/m/d');
                    $total = DB::table('View_UnionReportmontly')
                        ->where('date', $rew)
                        ->sum('total');
                    $number_return = DB::table('View_UnionReportmontly')
                        ->where('date', $rew)
                        ->sum('number_return');
                    $number = DB::table('View_UnionReportmontly')
                        ->where('date', $rew)
                        ->sum('number');
                    $detail_customer_payment = DB::table('detail_customer_payment')
                        ->where('datee', $rew)
                        ->sum('price');
                    if ($total > 0 or $number_return > 0 or $number > 0 or $detail_customer_payment > 0) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                     data-id="' . $rew . '" data-original-title="جزییات"
                     class="detail-tolid">
                  ' . $rew . '
                   </a>';
                        return $btn;
                    } else {
                        return $rew;
                    }
                })
                ->addColumn('total', function ($row) {
                    $rew = Jalalian::forge($row)->format('Y/m/d');
                    $total = DB::table('factors')
                        ->where('date', $rew)
                        ->sum('total');
                    return $total;

                })
                ->addColumn('sum', function ($row) {
                    $rew = Jalalian::forge($row)->format('Y/m/d');
                    $sum = DB::table('View_UnionReportmontly')
                        ->where('date', $rew)
                        ->sum('sum');
                    return number_format($sum);

                })
                ->addColumn('sa', function ($row) {
                    $rew = Jalalian::forge($row)->format('Y/m/d');
                    $number_return = DB::table('View_UnionReportmontly')
                        ->where('date', $rew)
                        ->sum('number_return');
                    return $number_return;

                })
                ->addColumn('payment', function ($row) {
                    $rew = Jalalian::forge($row)->format('Y/m/d');
                    $detail_customer_payment = DB::table('detail_customer_payment')
                        ->where('datee', $rew)
                        ->sum('price');
                    return number_format($detail_customer_payment);

                })
                ->addColumn('as', function ($row) {
                    $rew = Jalalian::forge($row)->format('Y/m/d');
                    $number = DB::table('View_UnionReportmontly')
                        ->where('date', $rew)
                        ->sum('number');
//                    if ($number > 0) {
//                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
//                      data-id="' . $row . '" data-original-title="جزییات"
//                       class="detail-tolid">
//                      ' . $number . '
//                       </a>';
//                        return $btn;
//                    } else {
//
//                    }
                    return $number;
                })
                ->rawColumns(['date'])
                ->make(true);

        }
        return view('ReportMonthly.list');
    }

    public function ExitPrint(Request $request)
    {

        $users = User::all();
        $customers = Customer::all();
        $customer = [$request->id_custome];
        $user = [$request->id_user];
        $array_user = array();
        $array_customer = array();
        if ($request->type == 0) {
            $type = [0, 1];
        } elseif ($request->type == 1) {
            $type = [1];
        } else {
            $type = [0];
        }
        foreach ($users as $u) {
            $array_user[] = $u->id;
        }
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }

        if (!empty($request->id_user)) {
            $user_id = [$request->id_user];
        } else {
            $user_id = $array_user;
        }
        if (!empty($request->id_custome)) {
            $customer_id = [$request->id_custome];
        } else {
            $customer_id = $array_customer;
        }


        if (!empty($request->intime)) {
            $indate = $request->intime;
        } else {
            $indate = "1370/04/10";
        }
        if (!empty($request->totime)) {
            $todate = $request->totime;
        } else {
            $todate = "1470/04/10";
        }
        $in = $request->intime;
        $to = $request->totime;
        if (!empty($request->id_custome)) {
            $namer = Customer::where('id', $request->id_custome)->first();
            $name = $namer->name;
        } else {
            $name = null;
        }
        if (!empty($request->id_user)) {
            $nameer = User::where('id', $request->id_user)->first();
            $namee = $nameer->name;
        } else {
            $namee = null;
        }

        if ($request->type == 0) {
            $types = 'همه';
        } elseif ($request->type == 1) {
            $types = 'پرداخت شده';
        } else {
            $types = 'پرداخت نشده';
        }


        $data = \DB::table('factors')
            ->whereIn('payment', $type)
            ->whereIn('user_id', $user_id)
            ->whereIn('customer_id', $customer_id)
            ->whereBetween('date', array($indate, $todate))
            ->get();


        $view = \View::make('ExitReport.print',
            compact('name'
                , 'in', 'to', 'namee', 'data', 'users', 'customers', 'types'));
        return $view->render();

    }

    public function CustomerTransactions(Request $request)
    {
        $customers = Customer::all();
        $status = collect([1]);
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        $customer = [$request->customer_id];
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


        if ($request->ajax()) {

//            $data = DB::select("CALL get_invoices()");

//            $data = DB::select("CALL get_invoices()");

            $data = \DB::table('View_Transaction')
                ->where('date', '!=', "1399")
                ->whereIn('customer_id', $customer)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('date', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('sum', function ($row) {
                    return number_format($row->sum);
                })
                ->addColumn('description', function ($row) {

                    if (!empty($row->return_id)) {
                        return 'بستانکار بابت مرجوعی با کد' . ' ' . $row->return_id;
                    } else {
                        if (!empty($row->price)) {
                            return $row->descriptionn;
                        } else {
                            return 'بدهی بابت فاکتور' . ' ' . $row->rahkaran;
                        }
                    }


                })
                ->rawColumns([])
                ->make(true);

        }
        return view('CustomerTransactions.list', compact('customers'));
    }

    public function ExitList(Request $request)
    {
        $role_id = DB::table('role_user')
            ->where('user_id', auth()->user()->id)
            ->first();
        $role_name = DB::table('roles')
            ->where('id', $role_id->role_id)
            ->first();
        if ($role_name->name == "Admin" or $role_name->name == "مدیریت") {
            $customers = Customer::all();
            $users = User::all();
        } else {
            $customers = Customer::where('expert', auth()->user()->id)->get();
            $users = User::where('id', auth()->user()->id)->get();
        }

        $array_customer = array();
        $array_user = array();
        if ($request->type == 0) {
            $type = [0, 1];
        } elseif ($request->type == 1) {
            $type = [1];
        } else {
            $type = [0];
        }
        foreach ($users as $u) {
            $array_user[] = $u->id;
        }
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        if (!empty($request->user_id)) {
            $user_id = [$request->user_id];
        } else {
            $user_id = $array_user;
        }
        if (!empty($request->customer_id)) {
            $customer = [$request->customer_id];
        } else {
            $customer = $array_customer;
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


        if ($request->ajax()) {

//            $data = DB::select("CALL get_invoices()");

//            $data = DB::select("CALL get_invoices()");

            $data = \DB::table('factors')
                ->whereIn('payment', $type)
                ->whereIn('user_id', $user_id)
                ->whereIn('customer_id', $customer)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pack_id', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack_id . '" data-original-title="جزییات"
                       class="detail-factor">
                      ' . $row->pack_id . '
                       </a>';
                    return $btn;
                })
                ->addColumn('customer_id', function ($row) {
                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;

                })
                ->addColumn('user_id', function ($row) {
                    $name = User::where('id', $row->user_id)->first();
                    return $name->name;

                })
                ->addColumn('payment', function ($row) {
                    if ($row->payment == 1) {
                        return 'پرداخت شده';
                    } else {
                        return 'پرداخت نشده';
                    }
                })
                ->addColumn('total', function ($row) {
                    $total = Scheduling::where('pack', $row->pack_id)->sum('total');
                    return $total;
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->sum);
                })
//                ->addColumn('payment', function ($row) {
//
//                    $pack = DB::table('clearing_factor')
//                        ->where('pack_id', $row->pack_id)->first();
//                    if (!empty($pack)) {
//                        $payment = DB::table('payments')
//                            ->where('clearing_id', $pack->clearing_id)->first();
//
//                        if (!empty($payment)) {
//                            return 'پرداخت شده';
//                        } else {
//                            return 'پرداخت نشده';
//                        }
//                    } else {
//                        return 'پرداخت نشده';
//                    }
//
//
//                })
                ->rawColumns(['pack_id'])
                ->make(true);

        }
        return view('ExitReport.list', compact('customers', 'users'));
    }

    public function Tolid(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('receiptproduct')
                ->where('date', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $detail = Product::
                    where('id', $row->product_id)
                        ->first();
                    return $detail->label;
                })
                ->addColumn('color', function ($row) {
                    $color = Color::where('id', $row->color_id)
                        ->first();
                    return $color->name;
                })
                ->addColumn('time', function ($row) {
                    $created = Carbon::make($row->created_at)->format('H:i:s');
                    return $created;
                })
                ->rawColumns([])
                ->make(true);
        }

        return view('ReportMonthly.list');

    }

    public function Frosh(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('factors')
                ->where('date', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    $detail = DB::table('schedulings')->
                    where('pack', $row->pack_id)
                        ->sum('total');
                    return $detail;
                })
                ->addColumn('price', function ($row) {

                    return number_format($row->sum);
                })
                ->addColumn('user_id', function ($row) {
                    $detail = User::
                    where('id', $row->user_id)
                        ->first();
                    return $detail->name;
                })
                ->addColumn('customer_id', function ($row) {
                    $detail = Customer::
                    where('id', $row->customer_id)
                        ->first();
                    return $detail->name;
                })
                ->rawColumns([])
                ->make(true);
        }

        return view('ReportMonthly.list');

    }

    public function Mar(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('returns')
                ->where('date', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('user', function ($row) {
                    $id = DB::table('detail_returns')->where('return_id', $row->id)
                        ->first();
                    $name = Invoice::where('id', $id->invoice_id)->first();
                    $user = User::where('id', $name->user_id)->first();
                    return $user->name;
                })
                ->addColumn('factor', function ($row) {
                    $id = DB::table('detail_returns')->where('return_id', $row->id)
                        ->first();
                    return $id->invoice_id;
                })
                ->addColumn('number', function ($row) {
                    $id = DB::table('detail_returns')->where('return_id', $row->id)
                        ->sum('number');
                    return $id;
                })
                ->rawColumns([])
                ->make(true);
        }

        return view('ReportMonthly.list');

    }

    public function asnad(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('detail_customer_payment')
                ->where('datee', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('payment_id', function ($row) {
                    return 'بابت صورتحساب' . " " . $row->payment_id;
                })
                ->addColumn('type', function ($row) {
                    if ($row->type == 1) {
                        return 'نقدی';
                    } else {
                        return 'چکی';
                    }
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->rawColumns([])
                ->make(true);
        }

        return view('ReportMonthly.list');

    }

    public function show($id)
    {
        return response()->json($id);

    }

    function displayDates($date1, $date2, $step = '+1 day', $format = 'Y/m/d')
    {
        $dates = array();
        $current = strtotime($date1);
        $last = strtotime($date2);

        while ($current <= $last) {
            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    public static function convert_numbers($input)
    {
        $persian = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $string = str_replace($persian, $english, $input);
        return $string;
    }
}
