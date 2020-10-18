<?php

namespace App\Http\Controllers\Sell;

use App\Color;
use App\Customer;
use App\Factors;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Product;
use App\SalesInvoice;
use App\Scheduling;
use App\User;
use Carbon\Carbon;
use DB;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Response;
use Validator;
use Yajra\DataTables\DataTables;


class SchedulingController extends Controller
{
    public function list(Request $request)
    {


        $id = auth()->user()->id;
        $role_id = \DB::table('role_user')
            ->where('user_id', $id)->first();
        $role = DB::table('roles')
            ->where('id', $role_id->role_id)
            ->first();

        if ($role->name == "مدیریت" or $role->name == "Admin" or $role->name == "کارشناس فروش و مالی" or $role->name == "مسئول حمل و نقل" or $role->name == "مدیر انبار" or $role->name == "مدیر کارخانه") {
            $user_id = [12, 13, 14, 15, 16, 17, 18, 19, 22, 24, 25, 26];
        }

        if ($role->name == "کارشناس فروش") {
            $user_id = [auth()->user()->id];
        }

        if (!empty($request->from_date)) {
            $indate = [$request->from_date];
            $todate = [$request->from_date];
        } else {
            $indate = "1395/04/10";
            $todate = "1450/04/01";
        }

        if (!empty($request->from_check)) {
            $indate = "1395/04/10";
            $todate = "1450/04/01";
            $list = $request->from_check;
        } else {
            $list = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        }
        if ($request->ajax()) {
            $data = DB::table('View_Scheduling')
                ->whereIn('user_id', $user_id)
                ->whereIn('status', $list)
                ->whereBetween('date', array($indate, $todate))
                ->orderBy('id', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->customer_id . '" data-original-title="ثبت تعداد خروجی"
                       class="customer">
                  ' . $row->customer_name . '
                       </a>&nbsp;&nbsp;';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status != 6) {
                        if (!empty($row->statusfull)) {
                            if ($row->statusfull == 8) {
                                return 'خروج کامل';
                            } elseif ($row->statusfull == 9) {
                                return 'خروج ناقص';
                            }
                        } else {
                            if ($row->status == 0) {
                                return 'ثبت اولیه';
                            } elseif ($row->status == 1) {
                                return 'تایید ثبت';
                            } elseif ($row->status == 2) {
                                return 'تایید حواله';
                            } elseif ($row->status == 3) {
                                return 'خروج کامل';
                            } elseif ($row->status == 4) {
                                return 'خروج ناقص';
                            } elseif ($row->status == 5) {
                                return 'عدم خروج';
                            } elseif ($row->status == 6) {
                                return 'اتمام یافته';
                            }
                        }

                    } else {
                        return 'اتمام یافته';
                    }

                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'customer_name'])
                ->make(true);
        }
        return view('Scheduling.list');

    }

    public function detaillist(Request $request)
    {
        if ($request->ajax()) {
            $dataa = Scheduling::where('pack', $request->product_id)
                ->orderBy('id', 'desc')->get();
            return Datatables::of($dataa)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product_id = \DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $name = Product::where('id', $product_id->product_id)->first();
                    return $name->label;
                })
                ->addColumn('color', function ($row) {
                    $product_id = \DB::table('invoice_product')
                        ->where('id', $row->detail_id)
                        ->first();
                    $name = Color::where('id', $product_id->color_id)->first();
                    return $name->name;
                })
                ->addColumn('actionn', function ($row) {
                    return $this->actionn($row);
                })
                ->rawColumns(['actionn'])
                ->make(true);
        }
        return view('Scheduling.list');

    }

    public function success($id)
    {
        $data = Scheduling::where('pack', $id)->update([
            'status' => 1,
        ]);
        return response()->json($data);

    }

    public function update($id)
    {


        $product = \DB::table('_success_number_invoice')
            ->where('scheduling_id', $id)
            ->first();
        return response()->json($product);
    }

    public function StoreExit(Request $request)
    {


        $total = null;
        $verta = verta();
        $date = Carbon::now();

        $validator = Validator::make($request->all(), [
            'numberexit.*' => 'required',
        ], [
            'numberexit.*.required' => 'لطفا مقدار خارج شده از انبار را وارد کنید',
        ]);
        $id_invoi = count(collect($request)->get('id_invoi'));
        if (!empty($request->updatee)) {
            if ($validator->passes()) {
                for ($i = 0; $i < $id_invoi; $i++) {
                    $id = Scheduling::where('id', $request->get('id_invoi')[$i])->first();
                    $id_p = \DB::table('invoice_product')
                        ->where('id', $id->detail_id)->first();
                    $total += $request->numberexit[$i] * $id_p->salesPrice;
                    $barn = \DB::table('barns_products')
                        ->where('product_id', $id_p->product_id)
                        ->where('color_id', $id_p->color_id)
                        ->first();
                    $min = $id->number - $request->get('numberexit')[$i];

                    \DB::beginTransaction();
                    try {
                        \DB::table('exitproductbarn')
                            ->where('detail_id', $request->get('id_invoi')[$i])
                            ->update([
                                'number' => $request->get('numberexit')[$i],
                            ]);
                        if ($request->get('numberexit')[$i] == $id_p->salesNumber) {
                            Scheduling::where('id', $request->get('id_invoi')[$i])->update([
                                'total' => $request->get('numberexit')[$i],
                            ]);


                            \DB::table('barns_products')
                                ->where('product_id', $id_p->product_id)
                                ->where('color_id', $id_p->color_id)
                                ->update([
                                    'Inventory' => $barn->Inventory + $id->total,
                                    'NumberSold' => abs($barn->NumberSold - $id->total),
                                ]);

                            \DB::table('invoice_product')
                                ->where('id', $id->detail_id)
                                ->update([
                                    'leftover' => $id_p->leftover - $id->total,
                                ]);


                            \DB::table('barns_products')
                                ->where('product_id', $id_p->product_id)
                                ->where('color_id', $id_p->color_id)
                                ->update([
                                    'Inventory' => $barn->Inventory - $request->get('numberexit')[$i],
                                    'NumberSold' => abs($barn->NumberSold - $request->get('numberexit')[$i]),
                                ]);

                            \DB::table('invoice_product')
                                ->where('id', $id->detail_id)
                                ->update([
                                    'leftover' => $id->number - $request->get('numberexit')[$i] + $id_p->leftover,
                                ]);

                            Scheduling::where('pack', $request->get('pack')[$i])
                                ->update([
                                    'statusfull' => 8,
                                ]);


                        } elseif ($request->get('numberexit')[$i] < $id_p->salesNumber and $request->get('numberexit')[$i] > 0) {

                            Scheduling::where('id', $request->get('id_invoi')[$i])->update([
                                'total' => $request->get('numberexit')[$i],
                            ]);


                            \DB::table('invoice_product')
                                ->where('id', $id->detail_id)
                                ->update([
                                    'leftover' => $min + $id_p->leftover,
                                    'end' => null,
                                ]);


                            \DB::table('barns_products')
                                ->where('product_id', $id_p->product_id)
                                ->where('color_id', $id_p->color_id)
                                ->update([
                                    'Inventory' => $barn->Inventory - $request->get('numberexit')[$i],
                                    'NumberSold' => abs($barn->NumberSold - $request->get('numberexit')[$i]),
                                ]);


                            Scheduling::where('pack', $request->get('pack')[$i])
                                ->update([
                                    'statusfull' => 9,
                                ]);


                        } elseif ($request->get('numberexit')[$i] == 0) {
                            Scheduling::find($request->get('id_invoi')[$i])->update([
                                'status' => 5,
                                'statusfull' => null,
                                'end' => 2,
                                'total' => $request->get('numberexit')[$i],
                            ]);

                        }
                        \DB::commit();
                    } catch (Exception $exception) {
                        \DB::rollBack();
                    }

                }
                $pack_total = Scheduling::where('pack', $request->pack[0])->sum('total');
                $p = array();
                $sum = null;
                $customer = DB::table('schedulings')
                    ->where('pack', $request->pack[0])
                    ->first();

                $invoice = DB::table('invoice_product')
                    ->where('id', $customer->detail_id)
                    ->first();

                $customer_id = DB::table('invoices')
                    ->where('id', $invoice->invoice_id)
                    ->first();

                $color = count($request->color);

                for ($u = 0; $u < $color; $u++) {
                    $price = DB::table('products')
                        ->where('id', $request->producte[$u])
                        ->first();
                    $r = $request->numberexit[$u] * $price->price;
                    $p[] += $r;
                }
                $v = count($p);
                for ($w = 0; $w < $v; $w++) {
                    $sum += $p[$w];
                }

                $s = $total - $customer_id->ta;
                DB::table('factors')
                    ->insert([
                        'pack_id' => $request->pack[0],
                        'customer_id' => $customer_id->customer_id,
                        'user_id' => $customer_id->user_id,
                        'sum' => $s,
                        'status' => 0,
                        'Month' => $verta->month,
                        'Year' => $verta->year,
                        'total' => $pack_total,
                        'date' => Jalalian::forge($date)->format('Y/m/d'),
                        'type' => $customer_id->paymentMethod,
                        'created_at' => $date,
                        'payment' => 0,
                    ]);
                return response()->json(['success' => 'success']);
            }
            return Response::json(['errors' => $validator->errors()]);
        } else {
            if ($validator->passes()) {
                for ($i = 0; $i < $id_invoi; $i++) {
                    $id = Scheduling::where('id', $request->get('id_invoi')[$i])->first();
                    $id_p = \DB::table('invoice_product')
                        ->where('id', $id->detail_id)->first();

                    $total += $request->numberexit[$i] * $id_p->salesPrice;

                    $barn = \DB::table('barns_products')
                        ->where('product_id', $id_p->product_id)
                        ->where('color_id', $id_p->color_id)
                        ->first();
                    $min = $id->number - $request->get('numberexit')[$i];

                    \DB::beginTransaction();
                    try {
                        \DB::table('exitproductbarn')
                            ->insert([
                                'detail_id' => $request->get('id_invoi')[$i],
                                'number' => $request->get('numberexit')[$i],
                            ]);
                        if ($request->get('numberexit')[$i] == $id_p->salesNumber) {
                            Scheduling::find($request->get('id_invoi')[$i])->update([
                                'total' => $request->get('numberexit')[$i],
                            ]);
                            \DB::table('barns_products')
                                ->where('product_id', $id_p->product_id)
                                ->where('color_id', $id_p->color_id)
                                ->update([
                                    'Inventory' => $barn->Inventory - $request->get('numberexit')[$i],
                                    'NumberSold' => $barn->NumberSold - $request->get('numberexit')[$i],
                                ]);
                            \DB::table('invoice_product')
                                ->where('id', $id->detail_id)
                                ->update([
                                    'leftover' => $id->number - $request->get('numberexit')[$i] + $id_p->leftover,
                                ]);
                            if (!empty($id->statusfull)) {
                                if ($id->statusfull == 8) {
                                    Scheduling::where('pack', $id->pack)->update([
                                        'statusfull' => 8,
                                    ]);
                                }
                            } else {
                                Scheduling::where('pack', $id->pack)->update([
                                    'statusfull' => 8,
                                ]);
                            }
                        } elseif ($request->get('numberexit')[$i] < $id_p->salesNumber and $request->get('numberexit')[$i] > 0) {
                            \DB::table('invoice_product')
                                ->where('id', $id->detail_id)
                                ->update([
                                    'leftover' => $min + $id_p->leftover,
                                    'end' => null,
                                ]);
                            Scheduling::find($request->get('id_invoi')[$i])->update([
                                'total' => $request->get('numberexit')[$i],
                            ]);
                            \DB::table('barns_products')
                                ->where('product_id', $id_p->product_id)
                                ->where('color_id', $id_p->color_id)
                                ->update([
                                    'Inventory' => $barn->Inventory - $request->get('numberexit')[$i],
                                    'NumberSold' => $barn->NumberSold - $id->number,
                                ]);


                            if (!empty($id->statusfull)) {
                                if ($id->statusfull == 8) {
                                    Scheduling::where('pack', $id->pack)->update([
                                        'statusfull' => 9,
                                    ]);
                                }
                            } else {
                                Scheduling::where('pack', $id->pack)->update([
                                    'statusfull' => 9,
                                ]);
                            }


                        } elseif ($request->get('numberexit')[$i] == 0) {
                            Scheduling::find($request->get('id_invoi')[$i])->update([
                                'status' => 5,
                                'statusfull' => null,
                                'end' => 2,
                                'total' => $request->get('numberexit')[$i],
                            ]);


                        }
                        \DB::commit();
                    } catch (Exception $exception) {
                        \DB::rollBack();
                    }
                }
                $pack_total = Scheduling::where('pack', $request->pack[0])->sum('total');
                $p = array();
                $sum = null;
                $customer = DB::table('schedulings')
                    ->where('pack', $request->pack[0])
                    ->first();

                $invoice = DB::table('invoice_product')
                    ->where('id', $customer->detail_id)
                    ->first();

                $customer_id = DB::table('invoices')
                    ->where('id', $invoice->invoice_id)
                    ->first();

                $color = count($request->color);

                for ($u = 0; $u < $color; $u++) {
                    $price = DB::table('products')
                        ->where('id', $request->producte[$u])
                        ->first();
                    $r = $request->numberexit[$u] * $price->price;
                    $p[] += $r;
                }
                $v = count($p);
                for ($w = 0; $w < $v; $w++) {
                    $sum += $p[$w];
                }

                $s = $total - $customer_id->ta;
                DB::table('factors')
                    ->insert([
                        'pack_id' => $request->pack[0],
                        'customer_id' => $customer_id->customer_id,
                        'user_id' => $customer_id->user_id,
                        'sum' => $s,
                        'status' => 0,
                        'Month' => $verta->month,
                        'Year' => $verta->year,
                        'total' => $pack_total,
                        'date' => Jalalian::forge($date)->format('Y/m/d'),
                        'type' => $customer_id->paymentMethod,
                        'created_at' => $date,
                        'payment' => 0,
                    ]);
                return response()->json(['success' => 'success']);
            }
            return Response::json(['errors' => $validator->errors()]);
        }

    }

    public function ExitFac(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'number' => 'required',
        ], [
            'number.required' => 'لطفا شماره فاکتور را وارد کنید',
        ]);
        $ids = Scheduling::where('pack', $request->produc)->get();
        foreach ($ids as $id)
            $detai = \DB::table('invoice_product')
                ->where('id', $id->detail_id)
                ->first();
        $details = \DB::table('invoice_product')
            ->where('id', $id->detail_id)
            ->where('status', null)
            ->get();
        $invoices = \DB::table('invoice_product')
            ->where('id', $id->detail_id)
            ->get();
        if ($validator->passes()) {
            \DB::beginTransaction();
            try {
                \DB::table('exitproductbarnfacs')
                    ->insert([
                        'detail_id' => $request->produc,
                        'number_fac' => $request->number,
                    ]);
                Scheduling::where('pack', $request->produc)->update([
                    'status' => 6,
                    'end' => 1,
                ]);
                Factors::where('pack_id', $request->produc)->update([
                    'rahkaran' => $request->number,
                ]);
                \DB::table('invoice_product')
                    ->where('id', $id->detail_id)
                    ->update([
                        'status' => 1,
                    ]);
                foreach ($details as $detail) {
                    if (empty($detail)) {
                        \DB::table('invoices')
                            ->where('id', $detai->invoice_id)
                            ->update([
                                'status' => 1,
                            ]);
                    }
                }
                foreach ($invoices as $invoice) {
                    \DB::table('invoices')
                        ->where('id', $invoice->invoice_id)
                        ->update([
                            'status' => 1,
                        ]);
                }
                \DB::commit();
                return response()->json(['success' => 'success']);
            } catch (Exception $exception) {
                \DB::rollBack();
            }
        }
        return Response::json(['errors' => $validator->errors()]);


    }

    public function exit($id)
    {
        $check = Scheduling::where('pack', $id)->first();
        if (!empty($check->total)) {
            $update = 1;
        } else {
            $update = null;
        }

        $data = Scheduling::where('pack', $id)->get();

        foreach ($data as $datum)
            $product = \DB::table('invoice_product')
                ->where('id', $datum->detail_id)
                ->first();
        $havale = \DB::table('_success_number_invoice')
            ->where('scheduling_id', $datum->pack)
            ->first();
        $invoice = Invoice::where('id', $product->invoice_id)->first();
        $customer = Customer::where('id', $invoice->customer_id)->first();

        return response()->json(['data' => $data,
            'invoice' => $invoice,
            'customer' => $customer,
            'hav' => $havale,
            'update' => $update]);
    }

    public function ubargiri($id)
    {
        $date = Scheduling::where('pack', $id)->first();
        return response()->json($date);

    }

    public function customer($id)
    {
        $type = Customer::where('id', $id)
            ->first();
        $type_script = DB::table('type_customers')
            ->where('id', $type->type)->first();

        if ($type_script->type == 2) {
            $customer_personal = DB::table('customer_personal')
                ->where('customer_id', $id)
                ->first();
            return response()->json(['customer_personal' => $customer_personal]);
        }
        if ($type_script->type == 1) {
            $customer_company = DB::table('customer_company')
                ->where('customer_id', $id)
                ->first();
            return response()->json(['customer_company' => $customer_company]);

        }


    }

    public function bargiri(Request $request)
    {

        Scheduling::where('pack', $request->id_pp)
            ->update([
                'type' => $request->type,
                'time' => $request->time,
                'description' => $request->descrtiption,
            ]);
        return response()->json(['success' => 'success']);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required',
        ], [
            'number.required' => 'لطفا شماره حواله را وارد کنید',
        ]);
        $data = Carbon::now();
        if ($validator->passes()) {
            if (empty($request->id)) {
                \DB::beginTransaction();
                try {
                    \DB::table('_success_number_invoice')
                        ->insert([
                            'number' => $request->number,
                            'scheduling_id' => $request->product_id,
                            'created_at' => $data,
                        ]);
                    Scheduling::where('pack', $request->product_id)->update([
                        'status' => 2,
                    ]);
                    \DB::commit();
                    return response()->json(['success' => 'success']);
                } catch (Exception $exception) {
                    \DB::rollBack();
                }
            } else {
                \DB::beginTransaction();
                try {
                    \DB::table('_success_number_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'number' => $request->number,
                            'created_at' => $data,
                        ]);
                    Scheduling::where('pack', $request->product_id)->update([
                        'status' => 2,
                    ]);
                    \DB::commit();
                    return response()->json(['success' => 'success']);
                } catch (Exception $exception) {
                    \DB::rollBack();
                }
            }
        }
        return Response::json(['errors' => $validator->errors()]);


    }

    public function updatedate(Request $request)
    {
        $schedulings = DB::table('schedulings')->latest('id')->first();
        $scheduling = DB::table('schedulings')
            ->where('id', $request->id_d)->first();
        try {
            DB::beginTransaction();
            Scheduling::create([
                'detail_id' => $scheduling->detail_id,
                'number' => $scheduling->number,
                'type' => $scheduling->type,
                'Carry' => $scheduling->Carry,
                'date' => $this->convert2english($request->date),
                'time' => $scheduling->time,
                'description' => $scheduling->description,
                'pack' => '1000' . $schedulings->id,
                'status' => '0',
            ]);
            Scheduling::where('id', $request->id_d)
                ->update([
                    'end' => null,
                    'total' => '0',
                ]);
            Scheduling::where('pack', $scheduling->pack)->update([
                'statusfull' => '9',
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'success']);
    }

    public function updatedatee(Request $request)
    {

        DB::table('schedulings')
            ->where('pack', $request->id_de)
            ->update([
                'date' => $request->daatee,
            ]);
        return response()->json(['success' => 'success']);
    }

    public function canceldetail(Request $request)
    {
        $id = Scheduling::where('id', $request->id_p)->first();
        $detai = \DB::table('invoice_product')
            ->where('id', $id->detail_id)
            ->first();
        $barn = \DB::table('barns_products')
            ->where('product_id', $detai->product_id)
            ->where('color_id', $detai->color_id)
            ->first();
        \DB::table('_cancel_detail_product')
            ->insert([
                'scheduling_id' => $request->id_p,
                'reason' => $request->reason,
                'description' => $request->description,

            ]);

        Scheduling::where('id', $request->id_p)->update([
            'statusfull' => '9',
            'end' => null,
        ]);

        \DB::table('invoice_product')
            ->where('id', $id->detail_id)
            ->update([
                'leftover' => $id->number + $detai->leftover,
                'end' => null,
            ]);
        \DB::table('barns_products')
            ->where('product_id', $detai->product_id)
            ->where('color_id', $detai->color_id)
            ->update([
                'NumberSold' => $barn->NumberSold - $id->number,
            ]);

        return response()->json(['success' => 'success']);

    }

    public function print($id)
    {
        $check = SalesInvoice::where('number_pak', $id)->first();
        if (!empty($check)) {
            $pooducts = Product::all();
            $colors = Color::all();
            $invoice_products = DB::table('invoice_product')
                ->get();
            $products = Scheduling::where('pack', $id)
                ->where('total', '!=', 0)->get();

            $name = Scheduling::where('pack', $id)
                ->where('total', '!=', 0)->first();

            $name_user = DB::table('invoice_product')
                ->where('id', $name->detail_id)->first();

            $invoices = Invoice::where('id', $name_user->invoice_id)->first();

            $customers = Customer::where('id', $invoices->customer_id)->first();

            $detail_customer = DB::table('type_customers')
                ->where('id', $customers->type)->first();


            if ($detail_customer->type == 1) {
                $customer_company = DB::table('customer_company')
                    ->where('customer_id', $customers->id)->first();
                return view('Scheduling.print.list',
                    compact('invoice_products', 'check', 'colors', 'customer_company', 'pooducts', 'products', 'customers', 'invoices'));

            } else {
                $customer_personal = DB::table('customer_personal')
                    ->where('customer_id', $customers->id)->first();
                return view('Scheduling.print.list',
                    compact('invoice_products', 'check', 'colors', 'customer_personal', 'pooducts', 'products', 'customers', 'invoices'));

            }
        } else {
            $number_id = DB::table('sales_invoices')
                ->latest()
                ->first();
            if (!empty($number_id)) {
                $num = $number_id->id + 1;
            } else {
                $num = 1;
            }
            $now_date = new Verta();
            $year = substr($now_date->year, strpos($now_date->year, '://') + 2, 6);

            $factor = SalesInvoice::create([
                'number_factor' => $year . '100' . $num,
                'number_pak' => $id,
            ]);

            $pooducts = Product::all();
            $colors = Color::all();
            $invoice_products = DB::table('invoice_product')
                ->get();
            $products = Scheduling::where('pack', $id)
                ->where('total', '!=', 0)->get();

            $name = Scheduling::where('pack', $id)
                ->where('total', '!=', 0)->first();

            $name_user = DB::table('invoice_product')
                ->where('id', $name->detail_id)->first();

            $invoices = Invoice::where('id', $name_user->invoice_id)->first();

            $customers = Customer::where('id', $invoices->customer_id)->first();

            $detail_customer = DB::table('type_customers')
                ->where('id', $customers->type)->first();


            if ($detail_customer->type == 1) {
                $customer_company = DB::table('customer_company')
                    ->where('customer_id', $customers->id)->first();
                return view('Scheduling.print.list',
                    compact('invoice_products', 'factor', 'colors', 'customer_company', 'pooducts', 'products', 'customers', 'invoices'));

            } else {
                $customer_personal = DB::table('customer_personal')
                    ->where('customer_id', $customers->id)->first();
                return view('Scheduling.print.list',
                    compact('invoice_products', 'factor', 'colors', 'customer_personal', 'pooducts', 'products', 'customers', 'invoices'));

            }
        }


    }

    public function actions($row)
    {
        $btn = null;


        if ($row->status == 5 and $row->end == 2) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="تغیر تاریخ بارگیری"
                       class="change-date">
                  <i class="fa fa-history fa-lg" title="تغیر تاریخ بارگیری"></i>
                       </a>&nbsp;&nbsp;';

            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="انصراف فروش"
                       class="cancel">
                  <i class="fa fa-times fa-lg" title="انصراف فروش"></i>
                       </a>&nbsp;&nbsp;';

        }
        if ($row->end == null) {
            if ($row->status == 0) {
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش"
                       class="success-plus">
                  <i class="fa fa-check fa-lg" title="تایید و ثبت"></i>
                       </a>&nbsp;&nbsp;';
            }
            if ($row->status != 0) {
                if (\Gate::check('ثبت شماره حواله حسابداری')) {
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش"
                       class="plus-number">
                  <i class="fa fa-exchange fa-lg" title="ثبت شماره حواله حسابداری"></i>
                       </a>&nbsp;&nbsp;';
                }
                if ($row->status = 2) {
                    if (\Gate::check('ثبت اطلاعات خروج')) {
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش"
                       class="plus-exit">
                  <i class="fa fa-send fa-lg" title="ثبت اطلاعات خروج"></i>
                       </a>&nbsp;&nbsp;';
                    }
                    if ($row->statusfull != null) {
                        if (\Gate::check('ثبت شماره فاکتور')) {
                            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش"
                       class="send-fac">
                  <i class="fa fa-plus fa-lg" title="ثبت شماره فاکتور"></i>
                       </a>&nbsp;&nbsp;';
                        }
                        $btn = $btn . '<a href="' . route('admin.Scheduling.print', $row->pack) . '" target="_blank">
                       <i class="fa fa-print fa-lg" title="چاپ فاکتور فروش"></i>
                       </a>&nbsp;&nbsp;';
                    }

                }
            }
            if (\Gate::check('ویرایش مشخصات ارسال بار')) {
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="ویرایش مشخصات ارسال بار"
                       class="EditCar">

                       <i class="fa fa-truck fa-lg" title="ویرایش مشخصات ارسال بار"></i>

                       </a>&nbsp;&nbsp;';
            }
        }

        if (\Gate::check('تغییر تاریخ بارگیری')) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->pack . '" data-original-title="تغییر تاریخ بارگیری"
                       class="change-datee">
                  <i class="fa fa-history fa-lg" title="تغییر تاریخ بارگیری"></i>
                       </a>&nbsp;&nbsp;';
        }

        return $btn;

    }

    public function actionn($row)
    {
        $btn = null;
        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ثبت تعداد خروجی"
                       class="plus-number-exit">
                  <i class="fa fa-plus fa-lg" title="ثبت تعداد خروجی"></i>
                       </a>&nbsp;&nbsp;';
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
