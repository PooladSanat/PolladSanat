<?php

namespace App\Http\Controllers\Payment;

use App\Customer;
use App\CustomerAccount;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class PaymentDocumentController extends Controller
{
    public function list(Request $request)
    {
        $array_customer = array();
        $customers = Customer::all();
        $users = User::all();
        foreach ($customers as $c) {
            $array_customer[] = $c->id;
        }
        if ($request->ajax()) {
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
            if (!$request->name == 0) {
                $name = [$request->name];
            } else {
                $name = ['بانک ملّی ایران', 'بانک سپه', 'بانک صنعت و معدن', 'بانک کشاورزی'
                    , 'بانک مسکن', 'بانک توسعه صادرات ایران', 'بانک توسعه تعاون', 'پست بانک ایران', 'بانک اقتصاد نوین', 'بانک پارسیان', 'بانک کارآفرین'
                    , 'بانک سامان', 'بانک سینا', 'بانک خاور میانه', 'بانک شهر', 'بانک دی', 'بانک صادرات', 'بانک ملت', 'بانک تجارت', 'بانک رفاه'
                    , 'بانک حکمت ایرانیان', 'بانک گردشگری', 'بانک ایران زمین', 'بانک قوامین', 'بانک انصار', 'بانک سرمایه', 'بانک پاسارگاد', 'بانک مشترک ایران-ونزوئلا', 'بانک قرض‌الحسنه مهر ایران'
                    , 'بانک قرض‌الحسنه رسالت', 'بانک آینده', 'بانک تات', 'موسسه اعتباری توسعه تعاون', 'بانک آینده'];
            }
//            $data = DB::select("CALL get_invoices()");
            $data = \DB::table('detail_customer_payment')
                ->whereIn('customer_id', $customer)
                ->whereIn('name', $name)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('created_at', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('payment_id', function ($row) {
                    if (!empty($row->payment_id)) {
                        return $row->payment_id;
                    } else {
                        return 'شارژ حساب';
                    }
                })
                ->addColumn('type', function ($row) {
                    if ($row->type == 2) {
                        return 'چک';
                    } else {
                        return 'نقد';
                    }
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('create', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'وصول نشده';
                    } elseif ($row->status == 2) {
                        return 'وصول شده';
                    } else {
                        return 'برگشت خورده';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Paymentdocuments.list', compact('users', 'customers'));

    }

    public function store(Request $request)
    {
        \DB::table('detail_customer_payment')
            ->where('id', $request->id_status)
            ->update([
                'status' => $request->status,
                'description' => $request->description,
            ]);
        return response()->json(['success' => 'success']);

    }

    public function paymentlist($id)
    {
        $data = CustomerAccount::where('customer_id', $id)->first();
        $dataa = Customer::where('id', $id)->first();

        return response()->json(['data' => $data, 'dataa' => $dataa]);

    }

    public function actions($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ثبت وضعیت"
                       class="detail-payment-status">
                       <i class="fa fa-file fa-lg" title="ثبت وضعیت"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;

    }
}
