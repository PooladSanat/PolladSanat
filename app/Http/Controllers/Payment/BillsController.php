<?php

namespace App\Http\Controllers\Payment;

use App\Customer;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BillsController extends Controller
{

    public function list(Request $request)
    {
        $customers = Customer::all();
        $users = User::all();
        $status = collect([0, 2, 3]);
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        if ($request->ajax()) {
//            $data = DB::select("CALL get_invoices()");
            if ($request->customer_id == 0) {
                $customer = $array_customer;
            } else {
                $customer = [$request->customer_id];
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
//            $data = DB::select("CALL get_invoices()");
            $data = \DB::table('clearing')
                ->whereIn('status', $status)
                ->whereIn('customer_id', $customer)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('date', 'desc')
                ->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="detail-factor">
                      ' . $row->id . '
                       </a>';
                    return $btn;
                })
                ->addColumn('price', function ($row) {
                    $price = number_format($row->price);
                    return $price;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 2) {
                        return 'در انتظار تایید مدیریت';
                    } elseif ($row->status == 0) {
                        return 'در انتظار بررسی';
                    }
                })

                ->addColumn('customer', function ($row) {

                    $pack_id = \DB::table('clearing_factor')
                        ->where('clearing_id', $row->id)
                        ->first();

                    $id = \DB::table('factors')
                        ->where('pack_id', $pack_id->pack_id)
                        ->first();

                    $name = Customer::where('id', $id->customer_id)
                        ->first();

                    return $name->name;

                })

                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns(['action', 'id'])
                ->make(true);
        }
        return view('bills.list', compact('customers', 'users'));
    }

    public function detaillist(Request $request)
    {
        $customers = Customer::all();
        $users = User::all();
        $status = collect([1]);
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        if ($request->ajax()) {
//            $data = DB::select("CALL get_invoices()");
            if ($request->customer_id == 0) {
                $customer = $array_customer;
            } else {
                $customer = [$request->customer_id];
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
//            $data = DB::select("CALL get_invoices()");
            $data = \DB::table('clearing')
                ->whereIn('status', $status)
                ->whereIn('customer_id', $customer)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('date', 'desc')
                ->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="detail-factor">
                      ' . $row->id . '
                       </a>';
                    return $btn;
                })
                ->addColumn('price', function ($row) {
                    $price = number_format($row->price);
                    return $price;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 2) {
                        return 'در انتظار تایید مدیریت';
                    } elseif ($row->status == null) {
                        return 'در انتظار بررسی';
                    }
                })
                ->addColumn('customer', function ($row) {
                    $pack_id = \DB::table('clearing_factor')
                        ->where('clearing_id', $row->id)
                        ->first();

                    $id = \DB::table('factors')
                        ->where('pack_id', $pack_id->pack_id)
                        ->first();

                    $name = Customer::where('id', $id->customer_id)
                        ->first();

                    return $name->name;

                })
                ->addColumn('actioonn', function ($row) {
                    return $this->actioonn($row);
                })
                ->rawColumns(['actioonn','id'])
                ->make(true);
        }
        return view('bills.detaillist', compact('users', 'customers'));
    }

    public function SuccessAdmin($id)
    {
        $data = \DB::table('clearing')
            ->where('id', $id)->update([
                'status' => 2,
            ]);
        return response()->json($data);

    }

    public function PrintPayment($id)
    {
        $pack = array();
        $clearing_factor = \DB::table('clearing_factor')
            ->where('clearing_id', $id)
            ->get();
        foreach ($clearing_factor as $item)
            $pack[] = $item->pack_id;
        $factors = \DB::table('factors')
            ->whereIn('pack_id', $pack)
            ->get();

        return view('bills.print', compact('factors'));

    }

    public function action($row)
    {
        $btn = null;
        if ($row->status == 3) {
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="تسویه حساب"
                       class="detail-eye">
                       <i class="fa fa-plus fa-lg" title="تسویه حساب"></i>
                       </a>&nbsp;&nbsp;';
            $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ارجاع به مدیریت"
                       class="detail-gate-admin">
                       <i class="fa fa-reply fa-lg" title="ارجاع به مدیریت"></i>
                       </a>&nbsp;&nbsp;';
        }
        if (\Gate::check('اکشن تسویه حساب')) {
            if ($row->status == 0) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="تسویه حساب"
                       class="detail-eye">
                       <i class="fa fa-plus fa-lg" title="تسویه حساب"></i>
                       </a>&nbsp;&nbsp;';
            }
        }
        if (\Gate::check('اکشن تسویه حساب با نظر مدیریت')) {
            if ($row->status == 2) {
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="تایید مدیریت"
                       class="detail-admin">
                       <i class="fa fa-user fa-lg" title="تایید مدیریت"></i>
                       </a>&nbsp;&nbsp;';

            }
        }


        return $btn;

    }

    public function actioonn($row)
    {
        $btn = null;


        $btn = '<a href="' . route('admin.bills.print.detail', $row->id) . '" target="_blank">
                        <i class="fa fa-print fa-lg" title="چاپ صورت حساب"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;

    }

}
