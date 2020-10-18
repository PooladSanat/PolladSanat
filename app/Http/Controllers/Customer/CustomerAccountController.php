<?php

namespace App\Http\Controllers\Customer;

use App\Customer;
use App\CustomerAccount;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Provider\Payment;
use http\Env\Response;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class CustomerAccountController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Customer::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('creditor', function ($row) {
                    $creditor = \DB::table('customer_accounts')
                        ->where('customer_id', $row->id)
                        ->sum('creditor');
                    return number_format($creditor);
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('customeraccount.list');
    }

    public function store(Request $request)
    {


        $packs = array();
        $details = \DB::table('clearing_factor')
            ->where('clearing_id', $request->customer_ider)
            ->get();
        foreach ($details as $detail)
            $packs[] = $detail->pack_id;
        $created = Carbon::now()->timezone('Asia/Tehran');
        $price = null;
        $clearing_factor = \DB::table('clearing_factor')
            ->where('clearing_id', $request->customer_ider)
            ->first();
        $pack = \DB::table('factors')
            ->where('pack_id', $clearing_factor->pack_id)
            ->first();

        $pack_id = \DB::table('schedulings')
            ->where('pack', $clearing_factor->pack_id)
            ->first();

        $invoice_product = \DB::table('invoice_product')
            ->where('id', $pack_id->detail_id)
            ->first();
        $CustomerAccount = CustomerAccount::where('customer_id', $pack->customer_id)
            ->first();
        \DB::table('payments')
            ->insert([
                'clearing_id' => $request->customer_ider,
                'customer_id' => $pack->customer_id,
                'invoice_id' => $invoice_product->invoice_id,
            ]);
        $payment_id = \DB::table('payments')
            ->latest('id')->first();
        if (!empty($request->price)) {
            $count = count($request->price);
            for ($i = 0; $i < $count; $i++) {
                try {
                    $price = $price + $request->price[$i];
                    \DB::table('detail_customer_payment')
                        ->insert([
                            'customer_id' => $pack->customer_id,
                            'payment_id' => $payment_id->clearing_id,
                            'type' => $request->type[$i],
                            'shenase' => $request->shenase[$i],
                            'price' => $request->price[$i],
                            'date' => $request->date[$i],
                            'datee' => Jalalian::forge($created)->format('Y/m/d'),
                            'name' => $request->name[$i],
                            'name_user' => $request->user_name[$i],
                            'descriptionn' => $request->descriptionnn[$i],
                            'created_at' => $created,
                            'status' => 1,
                        ]);
                } catch (Exception $exception) {
                }
            }

        }
        $sum = $price + $request->cpriicee;
        if ($sum < $request->pricesuumm) {
            if (empty($CustomerAccount)) {
                CustomerAccount::create([
                    'customer_id' => $pack->customer_id,
                    'creditor' => $sum,
                ]);
            } else {
                CustomerAccount::where('customer_id', $pack->customer_id)
                    ->update([
                        'creditor' => $sum,
                    ]);
            }
            \DB::table('clearing')
                ->where('id', $request->customer_ider)
                ->update([
                    'status' => 3,
                    'description' => $request->des,
                ]);

        } else {
            if (empty($CustomerAccount)) {
                CustomerAccount::create([
                    'customer_id' => $pack->customer_id,
                    'creditor' => $sum - $request->pricesuumm,
                ]);
            } else {
                CustomerAccount::where('customer_id', $pack->customer_id)
                    ->update([
                        'creditor' => $sum - $request->pricesuumm,
                    ]);
                \DB::table('factors')
                    ->whereIn('pack_id', $packs)
                    ->update([
                        'status' => 1,
                        'payment' => 1,
                        'end' => 1,
                    ]);

            }


            \DB::table('clearing')
                ->where('id', $request->customer_ider)
                ->update([
                    'status' => 1,
                ]);
        }
        return response()->json(['success' => 'success']);


    }

    public function storee(Request $request)
    {

        $created = Carbon::now();
        $price = null;


        $CustomerAccount = CustomerAccount::where('customer_id', $request->customer_id)
            ->first();
        if (!empty($request->price)) {
            $count = count($request->price);
            for ($i = 0; $i < $count; $i++) {
                try {
                    $price = $price + $request->price[$i];
                    \DB::table('detail_customer_payment')
                        ->insert([
                            'customer_id' => $request->customer_id,
                            'type' => $request->type[$i],
                            'shenase' => $request->shenase[$i],
                            'price' => $request->price[$i],
                            'date' => $request->date[$i],
                            'datee' => Jalalian::forge($created)->format('Y/m/d'),
                            'name' => $request->name[$i],
                            'name_user' => $request->user_name[$i],
                            'descriptionn' => $request->descriptionnn[$i],
                            'created_at' => $created,
                            'status' => 1,
                        ]);
                } catch (Exception $exception) {
                }
            }

        }
        $sum = $price + $request->cpriicee;
        if ($sum < $request->pricesuumm) {
            if (empty($CustomerAccount)) {
                CustomerAccount::create([
                    'customer_id' => $request->customer_id,
                    'creditor' => $CustomerAccount->creditor + $sum,
                ]);
            } else {
                CustomerAccount::where('customer_id', $request->customer_id)
                    ->update([
                        'creditor' => $CustomerAccount->creditor + $sum,
                    ]);
            }

        } else {
            if (empty($CustomerAccount)) {
                CustomerAccount::create([
                    'customer_id' => $request->customer_id,
                    'creditor' => $CustomerAccount->creditor + $sum - $request->pricesuumm,
                ]);
            } else {
                CustomerAccount::where('customer_id', $request->customer_id)
                    ->update([
                        'creditor' => $CustomerAccount->creditor + $sum - $request->pricesuumm,
                    ]);

            }
        }
        return response()->json(['success' => 'success']);


    }

    public function print()
    {
        $customer_accounts = \DB::table('customer_accounts')->get();
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('customeraccount.print', compact('customers', 'customer_accounts'));

    }

    public function detail(Request $request)
    {


        if ($request->ajax()) {
            $data = \DB::table('detail_customer_payment')
                ->where('date', '!=', '1399')
                ->where('customer_id', $request->id_id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_id', function ($row) {
                    $customer = Customer::where('id', $row->customer_id)->first();
                    return $customer->name;
                })
                ->addColumn('type', function ($row) {
                    if ($row->type == 1) {
                        return 'نقدی';
                    } else {
                        return 'چک';
                    }
                })
                ->addColumn('shenase', function ($row) {
                    if ($row->shenase == null) {
                        return '----';
                    } else {
                        return $row->shenase;
                    }
                })
                ->addColumn('name', function ($row) {
                    if ($row->name == null) {
                        return '----';
                    } else {
                        return $row->name;
                    }
                })
                ->addColumn('name_user', function ($row) {
                    if ($row->name_user == null) {
                        return '----';
                    } else {
                        return $row->name_user;
                    }
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('created', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('customeraccount.listdetail');
    }

    public function list($id)
    {
        return view('customeraccount.listdetail', compact('id'));
    }

    public function update($id)
    {
        $data = \DB::table('detail_customer_payment')
            ->where('id', $id)
            ->first();
        return response()->json($data);

    }

    public function checkpayment($id)
    {
        $price = CustomerAccount::where('customer_id', $id)
            ->first();
        return response()->json($price);

    }

    public function patmentupdate(Request $request)
    {
        $string = preg_split("/,/", "$request->priced");
        $count = count($string);
        $number = null;
        for ($i = 0; $i < $count; $i++) {
            $number .= $string[$i];
        }
        CustomerAccount::where('customer_id', $request->cusomer_id_payment)
            ->update([
                'creditor' => $number,
            ]);
        return \response()->json(['success' => 'success']);

    }

    public function edit(Request $request)
    {


        $CustomerAccount = CustomerAccount::where('customer_id', $request->id_customer)->first();

        $detail_customer_payment = \DB::table('detail_customer_payment')
            ->where('id', $request->id_payment)->first();

        $clearing = \DB::table('clearing')
            ->where('id', $detail_customer_payment->payment_id)->first();

        \DB::beginTransaction();
        try {
            CustomerAccount::where('customer_id', $request->id_customer)
                ->update([
                    'creditor' => $CustomerAccount->creditor - $detail_customer_payment->price + $request->price,
                ]);

            \DB::table('detail_customer_payment')
                ->where('id', $request->id_payment)
                ->update([
                    'type' => $request->type,
                    'name' => $request->name,
                    'name_user' => $request->name_user,
                    'shenase' => $request->shanase,
                    'price' => $request->price,
                    'date' => $request->date,
                    'descriptionn' => $request->shahr,
                ]);
            if ($request->price < $clearing->price) {
                $clearings = array();
                $clearing_factor = \DB::table('clearing_factor')
                    ->where('clearing_id', $clearing->id)->get();
                foreach ($clearing_factor as $item) {
                    $clearings[] = $item->pack_id;
                }
                \DB::table('factors')
                    ->whereIn('pack_id', $clearings)
                    ->update([
                        'end' => null,
                        'payment' => 0,
                    ]);
                \DB::table('clearing')
                    ->where('id', $clearing->id)
                    ->update([
                        'status' => 0,
                    ]);
                \DB::table('payments')
                    ->where('clearing_id', $clearing->id)
                    ->delete();
            }

            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollBack();
        }
        return response()->json(['success' => 'success']);

    }

    public function delete($id)
    {
        $detail_customer_payment = \DB::table('detail_customer_payment')
            ->where('id', $id)->first();
        $CustomerAccount = CustomerAccount::where('customer_id', $detail_customer_payment->customer_id)->first();
        \DB::beginTransaction();
        try {
            CustomerAccount::where('customer_id', $detail_customer_payment->customer_id)
                ->update([
                    'creditor' => $CustomerAccount->creditor - $detail_customer_payment->price,
                ]);
            $post = \DB::table('detail_customer_payment')
                ->where('id', $id)->delete();
            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollBack();
        }
        return response()->json($post);
    }

    public function actions($row)
    {
        $btn = null;


        $btn = '<a href="' . route('admin.CustomerAccount.list', $row->id) . '">
                     <i class="fa fa-eye fa-lg" title="ریز پرداختی مشتری"></i>
                      </a>&nbsp;&nbsp;';
        if (\Gate::check('ویرایش موجودی مشتری')) {
            $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editpaymentcustomer">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';
        }
        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="شارژ حساب"
                       class="sharj">
                       <i class="fa fa-plus fa-lg" title="شارژ حساب"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function action($row)
    {
        $btn = null;


        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editpayment">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deletepayment">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';


        return $btn;

    }
}
