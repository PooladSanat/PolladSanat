<?php

namespace App\Http\Controllers\Customer;

use App\Areas;
use App\Customer;
use App\Http\Controllers\Controller;
use App\User;
use File;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * نمایش لیست مشتریان
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('phone', function ($row) {
                    $type = \DB::table('type_customers')
                        ->where('id', $row->type)->first();
                    if ($type->type == 1) {
                        $phone = \DB::table('customer_company')
                            ->where('customer_id', $row->id)
                            ->first();
                        if (!empty($phone->phone_company)) {
                            return $phone->phone_company;
                        } else {
                            return '----------';
                        }
                    } else {
                        $phone = \DB::table('customer_personal')
                            ->where('customer_id', $row->id)
                            ->first();
                        if (!empty($phone->phone_personel)) {
                            return $phone->phone_personel;
                        } else {
                            return '----------';
                        }
                    }
                })
                ->addColumn('tel', function ($row) {
                    $type = \DB::table('type_customers')
                        ->where('id', $row->type)->first();
                    if ($type->type == 1) {
                        $phone = \DB::table('customer_company')
                            ->where('customer_id', $row->id)
                            ->first();
                        if (!empty($phone->tel_company)) {
                            return $phone->tel_company;
                        } else {
                            return '----------';
                        }
                    } else {
                        $phone = \DB::table('customer_personal')
                            ->where('customer_id', $row->id)
                            ->first();
                        if (!empty($phone->tel_personel)) {
                            return $phone->tel_personel;
                        } else {
                            return '----------';
                        }
                    }
                })
                ->addColumn('adders', function ($row) {
                    $type = \DB::table('type_customers')
                        ->where('id', $row->type)->first();
                    if ($type->type == 1) {
                        $phone = \DB::table('customer_company')
                            ->where('customer_id', $row->id)
                            ->first();
                        if (!empty($phone->adders_company)) {
                            return $phone->adders_company;
                        } else {
                            return '----------';
                        }
                    } else {
                        $phone = \DB::table('customer_personal')
                            ->where('customer_id', $row->id)
                            ->first();
                        if (!empty($phone->adders_personel)) {
                            return $phone->adders_personel;
                        } else {
                            return '----------';
                        }
                    }
                })
                ->addColumn('areas', function ($row) {
                    $name = Areas::where('id', $row->staate)->first();
                    if (!empty($name)) {
                        return $name->areas;
                    } else {
                        return '-------';
                    }

                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Customer.list');


    }

    /**
     * نمایش صفحه ثبت اطلاعات مشتریان
     */
    public function wizard()
    {
        $states = Customer::distinct()->select('state')->groupBy('state')->get();
        $methods = Customer::distinct()->select('method')->groupBy('method')->get();
        $country = \DB::table('country')->get();
        $typeCustomers = \App\TypeCustomer::all();
        $recents = \DB::table('role_user')
            ->where('role_id', 2)
            ->get();
        $users = User::all();


        return view('Customer.wizard', compact('typeCustomers', 'recents', 'users', 'methods', 'states', 'country'));

    }


    public function information(Request $request)
    {
        return response()->json($request->id);

    }


    public function informationList(Request $request)
    {

        if ($request->ajax()) {
            $data = \DB::table('customers')
                ->where('id', $request->detail_factor)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('expert', function ($row) {
                    $detail = User::
                    where('id', $row->expert)
                        ->first();
                    return $detail->name;
                })
                ->addColumn('type', function ($row) {
                    $detail = \DB::table('type_customers')
                        ->where('id', $row->type)
                        ->first();
                    return $detail->name;
                })
                ->addColumn('phone', function ($row) {
                    $type = \DB::table('type_customers')
                        ->where('id', $row->type)
                        ->first();
                    if ($type->type == 2) {
                        $detail = \DB::table('customer_personal')
                            ->where('customer_id', $row->id)
                            ->first();
                        return $detail->phone_personel;
                    } else {
                        $detail = \DB::table('customer_company')
                            ->where('customer_id', $row->id)
                            ->first();
                        return $detail->phone_company;
                    }

                })
                ->addColumn('tel', function ($row) {
                    $type = \DB::table('type_customers')
                        ->where('id', $row->type)
                        ->first();
                    if ($type->type == 2) {
                        $detail = \DB::table('customer_personal')
                            ->where('customer_id', $row->id)
                            ->first();
                        return $detail->tel_personel;
                    } else {
                        $detail = \DB::table('customer_company')
                            ->where('customer_id', $row->id)
                            ->first();
                        return $detail->tel_company;
                    }

                })
                ->addColumn('adders', function ($row) {
                    $type = \DB::table('type_customers')
                        ->where('id', $row->type)
                        ->first();
                    if ($type->type == 2) {
                        $detail = \DB::table('customer_personal')
                            ->where('customer_id', $row->id)
                            ->first();
                        return $detail->adders_personel;
                    } else {
                        $detail = \DB::table('customer_company')
                            ->where('customer_id', $row->id)
                            ->first();
                        return $detail->adders_company;
                    }

                })
                ->addColumn('price', function ($row) {
                    $factors = \DB::table('factors')
                        ->where('customer_id', $row->id)
                        ->sum('sum');
                    $detail_customer_payment = \DB::table('detail_customer_payment')
                        ->where('customer_id', $row->id)
                        ->sum('price');
                    return $detail_customer_payment - $factors;
                })
                ->addColumn('pricee', function ($row) {
                    $factors = \DB::table('factors')
                        ->where('customer_id', $row->id)
                        ->sum('sum');
                    $detail_customer_payment = \DB::table('detail_customer_payment')
                        ->where('customer_id', $row->id)
                        ->sum('price');
                    return number_format(abs($detail_customer_payment - $factors));
                })
                ->rawColumns([])
                ->make(true);
        }

        return view('ReportMonthly.list');

    }

    public function traconesh(Request $request)
    {


        if ($request->ajax()) {
            $data = \DB::table('View_Transaction')
                ->where('date', '!=', "1399")
                ->where('customer_id', $request->customer_id)
                ->orderBy('date', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $detail_customer_payment = \DB::table('detail_customer_payment')
                        ->where('descriptionn', $row->descriptionn)
                        ->where('customer_id', $row->customer_id)
                        ->where('date', $row->date)
                        ->first();
                    if (!empty($detail_customer_payment)) {
                        return $detail_customer_payment->datee;

                    } else {
                        return $row->date;
                    }
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('sum', function ($row) {
                    return number_format($row->sum);
                })
                ->addColumn('description', function ($row) {
                    if (!empty($row->price)) {
                        return $row->descriptionn;
                    } else {
                        return 'بدهی بابت فاکتور' . ' ' . $row->rahkaran;
                    }
                })
                ->rawColumns([])
                ->make(true);

        }
        return view('home');
    }

    public function kharid(Request $request)
    {

        if ($request->ajax()) {
            $data = \DB::table('invoices')
                ->whereNull('dele')
                ->where('customer_id', $request->customer_id)
                ->orderBy('date', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('totalfinal', function ($row) {
                    return number_format($row->totalfinal);
                })
                ->addColumn('payment', function ($row) {
                    if ($row->payment == 1) {
                        return 'پرداخت شده';
                    } else {
                        return 'پرداخت نشده';
                    }
                })
                ->rawColumns([])
                ->make(true);

        }
        return view('home');
    }


    public function asnad(Request $request)
    {

        if ($request->ajax()) {
            $data = \DB::table('detail_customer_payment')
                ->where('date', '!=', '1399')
                ->where('customer_id', $request->customer_id)
                ->orderBy('date', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('payment_id', function ($row) {
                    if (!empty($row->payment_id)) {
                        return 'بابت فاکتور' . $row->payment_id;
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
                    if ($row->type != 2) {
                        return 'وصول شده';
                    } else {
                        if ($row->status == 1) {
                            return 'وصول نشده';
                        } elseif ($row->status == 2) {
                            return 'وصول شده';
                        } else {
                            return 'برگشت خورده';
                        }
                    }

                })
                ->rawColumns([])
                ->make(true);

        }
        return view('home');
    }


    /**
     * نمایش صفحه ثبت ویرایش مشخصات مشتریان
     */
    public function update(Customer $id)
    {
        $customer_company = \DB::table('customer_company')
            ->where('customer_id', $id->id)->first();
        $customer_work = \DB::table('customer_work')
            ->where('customer_id', $id->id)->first();
        $customer_banks = \DB::table('customer_bank')
            ->where('customer_id', $id->id)->get();
        $customer_securings = \DB::table('customer_securing')
            ->where('customer_id', $id->id)->get();
        $company_personals = \DB::table('company_personal')
            ->where('customer_id', $id->id)->get();
        $customer_personal = \DB::table('customer_personal')
            ->where('customer_id', $id->id)->first();
        $customer_document = \DB::table('customer_documents')
            ->where('customer_id', $id->id)->first();
        $states = Customer::distinct()->select('state')->groupBy('state')->get();
        $methods = Customer::distinct()->select('method')->groupBy('method')->get();
        $typeCustomers = \App\TypeCustomer::all();
        $country = \DB::table('country')->get();
        $recents = \DB::table('role_user')
            ->where('role_id', 2)
            ->get();
        $users = User::all();
        return view('Customer.update',
            compact('id', 'states', 'methods', 'typeCustomers', 'customer_company'
                , 'customer_work', 'customer_banks', 'customer_securings', 'company_personals'
                , 'customer_personal', 'country', 'recents', 'users', 'customer_document'
            ));
    }

    /**
     * ثبت اطلاعات مشتریان
     */
    public function store(Request $request)
    {


        $types = \App\TypeCustomer::where('id', $request->type)->get();
        foreach ($types as $type)
            if ($type->type == 1) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'methodd' => 'required',
                    'date' => 'required',
                    'expert' => 'required',
                    'tel_company' => 'required|integer',
                ], [
                    'name.required' => 'نام مشتری را وارد کنید',
                    'methodd.required' => 'نحوه آشنایی مشتری را وارد کنید',
                    'date.required' => 'تاریخ آشنایی مشتری را وارد کنید',
                    'expert.required' => 'کارشناس را وارد کنید',
                    'tel_company.required' => 'لطفا شماره تلفن دفتر را وارد کنید',
                    'tel_company.integer' => 'شماره تلفن دفتر مرکزی باید از نوع عددی باشذ',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'methodd' => 'required',
                    'date' => 'required',
                    'expert' => 'required',
                    'phone_personel' => 'required|integer',
                ], [
                    'name.required' => 'نام مشتری را وارد کنید',
                    'methodd.required' => 'نحوه آشنایی مشتری را وارد کنید',
                    'date.required' => 'تاریخ آشنایی مشتری را وارد کنید',
                    'expert.required' => 'کارشناس را وارد کنید',
                    'phone_personel.required' => 'لطفا شماره تماس مشتری را وارد کنید',
                    'phone_personel.integer' => 'شماره تلفن مشتری باید از نوع عددی باشد',
                ]);
        if (!empty($request->certificate_documents_company)) {
            if ($request->hasFile('certificate_documents_company')) {
                $file = $request->file('certificate_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $certificate_documents_company = $request->file('certificate_documents_company')
                    ->move('public/documents/certificate/', $name);
            }
        } else {
            $certificate_documents_company = null;

        }


        if ($request->hasFile('cart_documents_company')) {
            $file = $request->file('cart_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $cart_documents_company = $request->file('cart_documents_company')
                ->move('public/documents/cart/', $name);
        } else {
            $cart_documents_company = null;
        }
        if ($request->hasFile('activity_documents_company')) {
            $file = $request->file('activity_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $activity_documents_company = $request->file('activity_documents_company')
                ->move('public/documents/activity/', $name);
        } else {
            $activity_documents_company = null;

        }
        if ($request->hasFile('store_documents_company')) {
            $file = $request->file('store_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $store_documents_company = $request->file('store_documents_company')
                ->move('public/documents/store/', $name);
        } else {
            $store_documents_company = null;

        }
        if ($request->hasFile('ownership_documents_company')) {
            $file = $request->file('ownership_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $ownership_documents_company = $request->file('ownership_documents_company')
                ->move('public/documents/ownership/', $name);
        } else {
            $ownership_documents_company = null;

        }
        if ($request->hasFile('established_documents_company')) {
            $file = $request->file('established_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $established_documents_company = $request->file('established_documents_company')
                ->move('public/documents/established/', $name);
        } else {
            $established_documents_company = null;

        }
        if ($request->hasFile('sstore_documents_company')) {
            $file = $request->file('sstore_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $sstore_documents_company = $request->file('sstore_documents_company')
                ->move('public/documents/sstore/', $name);
        } else {
            $sstore_documents_company = null;

        }
        if ($request->hasFile('pstore_documents_company')) {
            $file = $request->file('pstore_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $pstore_documents_company = $request->file('pstore_documents_company')
                ->move('public/documents/pstore/', $name);
        } else {
            $pstore_documents_company = null;

        }
        if ($request->hasFile('final_documents_company')) {
            $file = $request->file('final_documents_company');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $final_documents_company = $request->file('final_documents_company')
                ->move('public/documents/final/', $name);
        } else {
            $final_documents_company = null;
        }

        if ($validator->passes()) {
            $customer = \App\Customer::create(
                [
                    'code' => $request->code,
                    'name' => $request->name,
                    'type' => $request->type,
                    'staate' => $request->staate,
                    'city' => $request->city,
                    'country' => $request->country,
                    'method' => $request->methodd,
                    'date' => $request->date,
                    'expert' => $request->expert,
                    'description' => $request->description,
                ]);
            if ($type->type == 1) {
                \DB::table('customer_company')->insert([
                    'customer_id' => $customer->id,
                    'code_company' => $request->code_company,
                    'Established_company' => $request->Established_company,
                    'tel_company' => $request->tel_company,
                    'fax_company' => $request->fax_company,
                    'adders_company' => $request->adders_company,
                    'post_company' => $request->post_company,
                    'phone_company' => $request->phone_company,
                    'home' => $request->adders_home,
                    'email_company' => $request->email_company,
                    'national_company' => $request->national_company,
                    'date_birth' => $request->date_birth,
                ]);
                \DB::table('customer_work')->insert([
                    'customer_id' => $customer->id,
                    'name_work_company' => $request->name_work_company,
                    'date_work_company' => $request->date_work_company,
                    'tel_work_company' => $request->tel_work_company,
                    'fax_work_company' => $request->fax_work_company,
                    'panel_work_company' => $request->panel_work_company,
                    'dimensions_work_company' => $request->dimensions_work_company,
                    'post_work_company' => $request->post_work_company,
                    'telstore_work_company' => $request->telstore_work_company,
                    'status_work_company' => $request->status_work_company,
                    'type_work_company' => $request->type_work_company,
                    'owner_work_company' => $request->owner_work_company,
                    'dec_work_company' => $request->dec_work_company,
                    'license_work_company' => $request->license_work_company,
                    'numlicense_work_company' => $request->numlicense_work_company,
                    'credibilitylicense_work_company' => $request->credibilitylicense_work_company,
                    'store_work_company' => $request->store_work_company,
                    'dimensionsstore_work_company' => $request->dimensionsstore_work_company,
                    'activity_work_company' => $request->activity_work_company,
                    'oactivity_work_company' => $request->oactivity_work_company,
                    'addersstore_work_company' => $request->addersstore_work_company,

                ]);
                \DB::table('customer_documents')->insert([
                    'customer_id' => $customer->id,
                    'certificate_documents_company' => $certificate_documents_company,
                    'cart_documents_company' => $cart_documents_company,
                    'activity_documents_company' => $activity_documents_company,
                    'store_documents_company' => $store_documents_company,
                    'ownership_documents_company' => $ownership_documents_company,
                    'established_documents_company' => $established_documents_company,
                    'sstore_documents_company' => $sstore_documents_company,
                    'pstore_documents_company' => $pstore_documents_company,
                    'final_documents_company' => $final_documents_company,
                ]);
                if (!empty($request->name_bank_company)) {
                    try {
                        $bank = count(collect($request)->get('name_bank_company'));
                        for ($i = 0; $i < $bank; $i++) {
                            \DB::table('customer_bank')->insert([
                                'customer_id' => $customer->id,
                                'name_bank_company' => $request->get('name_bank_company')[$i],
                                'branch_bank_company' => $request->get('branch_bank_company')[$i],
                                'account_bank_company' => $request->get('account_bank_company')[$i],
                                'date_bank_company' => $request->get('date_bank_company')[$i],
                            ]);
                        }
                    } catch (Exception $e) {
                    }
                }
                if (!empty($request->name_securing_company)) {
                    try {
                        $securing = count(collect($request)->get('name_securing_company'));
                        for ($t = 0; $t < $securing; $t++) {
                            \DB::table('customer_securing')->insert([
                                'customer_id' => $customer->id,
                                'name_securing_company' => $request->get('name_securing_company')[$t],
                                'date_securing_company' => $request->get('date_securing_company')[$t],
                            ]);
                        }
                    } catch (Exception $e) {
                    }
                }

                if (!empty($request->per_side_company)) {
                    try {
                        $size = count(collect($request)->get('per_side_company'));
                        for ($c = 0; $c < $size; $c++) {
                            \DB::table('company_personal')->insert([
                                'customer_id' => $customer->id,
                                'per_side_company' => $request->get('per_side_company')[$c],
                                'per_sex_company' => $request->get('per_sex_company')[$c],
                                'per_title_company' => $request->get('per_title_company')[$c],
                                'per_name_company' => $request->get('per_name_company')[$c],
                                'per_phone_company' => $request->get('per_phone_company')[$c],
                                'per_inside_company' => $request->get('per_inside_company')[$c],
                                'per_email_company' => $request->get('per_email_company')[$c],
                                'per_tel_company_company' => $request->get('per_tel_company_company')[$c],
                            ]);
                        }
                        return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
                    } catch (Exception $e) {
                    }
                }

                return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
            } else {
                \DB::table('customer_personal')->insert([
                    'customer_id' => $customer->id,
                    'sex' => $request->sex_personel,
                    'date_personel' => $request->date_personel,
                    'codemeli_personel' => $request->codemeli_personel,
                    'tel_personel' => $request->tel_personel,
                    'phone_personel' => $request->phone_personel,
                    'email_personel' => $request->email_personel,
                    'adders_personel' => $request->adders_personel,
                    'text_personel' => $request->text_personel,
                    'fax_personel' => $request->fax_personel,
                ]);
                return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
            }

        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * ویرایش مشخصات مشتریان
     */
    public function edit(Request $request)
    {
        $id = Customer::where('id', $request->id)->first();
        $document = \DB::table('customer_documents')
            ->where('customer_id', $request->id)
            ->first();

        $types = \App\TypeCustomer::where('id', $request->type)->get();
        foreach ($types as $type)
            if ($type->type == 1) {
                if ($id->code != $request->code) {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'methodd' => 'required',
                        'date' => 'required',
                        'expert' => 'required',
                        'tel_company' => 'required',
                    ], [
                        'name.required' => 'نام مشتری را وارد کنید',
                        'methodd.required' => 'نحوه آشنایی مشتری را وارد کنید',
                        'date.required' => 'تاریخ آشنایی مشتری را وارد کنید',
                        'expert.required' => 'کارشناس را وارد کنید',
                        'tel_company.required' => 'لطفا شماره تلفن دفتر مرکزی را وارد کنید',
                    ]);
                } else
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'methodd' => 'required',
                        'date' => 'required',
                        'expert' => 'required',
                        'tel_company' => 'required',
                    ], [
                        'name.required' => 'نام مشتری را وارد کنید',
                        'methodd.required' => 'نحوه آشنایی مشتری را وارد کنید',
                        'date.required' => 'تاریخ آشنایی مشتری را وارد کنید',
                        'expert.required' => 'کارشناس را وارد کنید',
                        'tel_company.required' => 'لطفا شماره تلفن دفتر مرکزی را وارد کنید',
                    ]);
            } else
                if ($id->code == $request->code) {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'methodd' => 'required',
                        'date' => 'required',
                        'expert' => 'required',
                        'phone_personel' => 'required',
                    ], [
                        'name.required' => 'نام مشتری را وارد کنید',
                        'methodd.required' => 'نحوه آشنایی مشتری را وارد کنید',
                        'date.required' => 'تاریخ آشنایی مشتری را وارد کنید',
                        'expert.required' => 'کارشناس را وارد کنید',
                        'phone_personel.required' => 'لطفا شماره تماس مشتری را وارد کنید',
                    ]);
                } else
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'methodd' => 'required',
                        'date' => 'required',
                        'expert' => 'required',
                        'phone_personel' => 'required',
                    ], [
                        'name.required' => 'نام مشتری را وارد کنید',
                        'methodd.required' => 'نحوه آشنایی مشتری را وارد کنید',
                        'date.required' => 'تاریخ آشنایی مشتری را وارد کنید',
                        'expert.required' => 'کارشناس را وارد کنید',
                        'phone_personel.required' => 'لطفا شماره تماس مشتری را وارد کنید',
                    ]);
        if ($type->type == 1) {


            if ($request->hasFile('certificate_documents_company')) {
                $file = $request->file('certificate_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $certificate_documents_company = $request->file('certificate_documents_company')
                    ->move('public/documents/certificate/', $name);
            } else {
                if (!empty($document)) {
                    $certificate_documents_company = $document->certificate_documents_company;
                } else {
                    $certificate_documents_company = null;
                }
            }
            if ($request->hasFile('cart_documents_company')) {
                $file = $request->file('cart_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $cart_documents_company = $request->file('cart_documents_company')
                    ->move('public/documents/cart/', $name);
            } else {

                if (!empty($document)) {
                    $cart_documents_company = $document->cart_documents_company;
                } else {
                    $cart_documents_company = null;
                }


            }
            if ($request->hasFile('activity_documents_company')) {
                $file = $request->file('activity_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $activity_documents_company = $request->file('activity_documents_company')
                    ->move('public/documents/activity/', $name);
            } else {
                if (!empty($document)) {
                    $activity_documents_company = $document->activity_documents_company;
                } else {
                    $activity_documents_company = null;
                }


            }
            if ($request->hasFile('store_documents_company')) {
                $file = $request->file('store_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $store_documents_company = $request->file('store_documents_company')
                    ->move('public/documents/store/', $name);
            } else {
                if (!empty($document)) {
                    $store_documents_company = $document->store_documents_company;
                } else {
                    $store_documents_company = null;
                }


            }
            if ($request->hasFile('ownership_documents_company')) {
                $file = $request->file('ownership_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $ownership_documents_company = $request->file('ownership_documents_company')
                    ->move('public/documents/ownership/', $name);
            } else {
                if (!empty($document)) {
                    $ownership_documents_company = $document->ownership_documents_company;
                } else {
                    $ownership_documents_company = null;
                }


            }
            if ($request->hasFile('established_documents_company')) {
                $file = $request->file('established_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $established_documents_company = $request->file('established_documents_company')
                    ->move('public/documents/established/', $name);
            } else {
                if (!empty($document)) {
                    $established_documents_company = $document->established_documents_company;
                } else {
                    $established_documents_company = null;
                }


            }
            if ($request->hasFile('sstore_documents_company')) {
                $file = $request->file('sstore_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $sstore_documents_company = $request->file('sstore_documents_company')
                    ->move('public/documents/sstore/', $name);
            } else {
                if (!empty($document)) {
                    $sstore_documents_company = $document->sstore_documents_company;
                } else {
                    $sstore_documents_company = null;
                }


            }
            if ($request->hasFile('pstore_documents_company')) {
                $file = $request->file('pstore_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $pstore_documents_company = $request->file('pstore_documents_company')
                    ->move('public/documents/pstore/', $name);
            } else {
                if (!empty($document)) {
                    $pstore_documents_company = $document->pstore_documents_company;
                } else {
                    $pstore_documents_company = null;
                }


            }
            if ($request->hasFile('final_documents_company')) {
                $file = $request->file('final_documents_company');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $final_documents_company = $request->file('final_documents_company')
                    ->move('public/documents/final/', $name);
            } else {
                if (!empty($document)) {
                    $final_documents_company = $document->final_documents_company;
                } else {
                    $final_documents_company = null;
                }


            }
        }
        if ($validator->passes()) {
            try {
                $customer = \App\Customer::find($request->id)->update(
                    [
                        'code' => $request->code,
                        'name' => $request->name,
                        'type' => $request->type,
                        'staate' => $request->staate,
                        'city' => $request->city,
                        'country' => $request->country,
                        'method' => $request->methodd,
                        'date' => $request->date,
                        'expert' => $request->expert,
                        'description' => $request->description,
                    ]);

                if ($type->type == 1) {
                    $customer_company = \DB::table('customer_company')
                        ->where('customer_id', $request->id)->first();

                    $customer_work = \DB::table('customer_work')
                        ->where('customer_id', $request->id)->first();

                    $customer_bank = \DB::table('customer_bank')
                        ->where('customer_id', $request->id)->first();

                    $customer_securing = \DB::table('customer_securing')
                        ->where('customer_id', $request->id)->first();

                    $customer_documents = \DB::table('customer_documents')
                        ->where('customer_id', $request->id)->first();

                    $company_personal = \DB::table('company_personal')
                        ->where('customer_id', $request->id)->first();


                    if (!empty($customer_company)) {
                        \DB::table('customer_company')
                            ->where('customer_id', $request->id)->update([
                                'code_company' => $request->code_company,
                                'Established_company' => $request->Established_company,
                                'tel_company' => $request->tel_company,
                                'fax_company' => $request->fax_company,
                                'adders_company' => $request->adders_company,
                                'post_company' => $request->post_company,
                                'phone_company' => $request->phone_company,
                                'home' => $request->adders_home,
                                'email_company' => $request->email_company,
                                'national_company' => $request->national_company,
                                'date_birth' => $request->date_birth,
                            ]);
                    } else {
                        \DB::table('customer_company')->insert([
                            'customer_id' => $request->id,
                            'code_company' => $request->code_company,
                            'Established_company' => $request->Established_company,
                            'tel_company' => $request->tel_company,
                            'fax_company' => $request->fax_company,
                            'adders_company' => $request->adders_company,
                            'post_company' => $request->post_company,
                            'phone_company' => $request->phone_company,
                            'home' => $request->adders_home,
                            'email_company' => $request->email_company,
                            'national_company' => $request->national_company,
                            'date_birth' => $request->date_birth,
                        ]);
                    }

                    if (!empty($customer_work)) {
                        \DB::table('customer_work')
                            ->where('customer_id', $request->id)->update([
                                'name_work_company' => $request->name_work_company,
                                'date_work_company' => $request->date_work_company,
                                'tel_work_company' => $request->tel_work_company,
                                'fax_work_company' => $request->fax_work_company,
                                'panel_work_company' => $request->panel_work_company,
                                'dimensions_work_company' => $request->dimensions_work_company,
                                'post_work_company' => $request->post_work_company,
                                'telstore_work_company' => $request->telstore_work_company,
                                'status_work_company' => $request->status_work_company,
                                'type_work_company' => $request->type_work_company,
                                'owner_work_company' => $request->owner_work_company,
                                'dec_work_company' => $request->dec_work_company,
                                'license_work_company' => $request->license_work_company,
                                'numlicense_work_company' => $request->numlicense_work_company,
                                'credibilitylicense_work_company' => $request->credibilitylicense_work_company,
                                'store_work_company' => $request->store_work_company,
                                'dimensionsstore_work_company' => $request->dimensionsstore_work_company,
                                'activity_work_company' => $request->activity_work_company,
                                'oactivity_work_company' => $request->oactivity_work_company,
                                'addersstore_work_company' => $request->addersstore_work_company,

                            ]);
                    } else {
                        \DB::table('customer_work')
                            ->insert([
                                'customer_id' => $request->id,
                                'name_work_company' => $request->name_work_company,
                                'date_work_company' => $request->date_work_company,
                                'tel_work_company' => $request->tel_work_company,
                                'fax_work_company' => $request->fax_work_company,
                                'panel_work_company' => $request->panel_work_company,
                                'dimensions_work_company' => $request->dimensions_work_company,
                                'post_work_company' => $request->post_work_company,
                                'telstore_work_company' => $request->telstore_work_company,
                                'status_work_company' => $request->status_work_company,
                                'type_work_company' => $request->type_work_company,
                                'owner_work_company' => $request->owner_work_company,
                                'dec_work_company' => $request->dec_work_company,
                                'license_work_company' => $request->license_work_company,
                                'numlicense_work_company' => $request->numlicense_work_company,
                                'credibilitylicense_work_company' => $request->credibilitylicense_work_company,
                                'store_work_company' => $request->store_work_company,
                                'dimensionsstore_work_company' => $request->dimensionsstore_work_company,
                                'activity_work_company' => $request->activity_work_company,
                                'oactivity_work_company' => $request->oactivity_work_company,
                                'addersstore_work_company' => $request->addersstore_work_company,

                            ]);
                    }


                    if (!empty($customer_bank)) {
                        \DB::table('customer_bank')
                            ->where('customer_id', $request->id)
                            ->delete();
                        try {
                            $bank = count(collect($request)->get('name_bank_company'));
                            for ($i = 0; $i <= $bank; $i++) {
                                \DB::table('customer_bank')->insert([
                                    'customer_id' => $request->id,
                                    'name_bank_company' => $request->get('name_bank_company')[$i],
                                    'branch_bank_company' => $request->get('branch_bank_company')[$i],
                                    'account_bank_company' => $request->get('account_bank_company')[$i],
                                    'date_bank_company' => $request->get('date_bank_company')[$i],
                                ]);
                            }
                        } catch (\Exception $e) {
                        }
                    } else {
                        try {
                            $bank = count(collect($request)->get('name_bank_company'));
                            for ($i = 0; $i <= $bank; $i++) {
                                \DB::table('customer_bank')->insert([
                                    'customer_id' => $request->id,
                                    'name_bank_company' => $request->get('name_bank_company')[$i],
                                    'branch_bank_company' => $request->get('branch_bank_company')[$i],
                                    'account_bank_company' => $request->get('account_bank_company')[$i],
                                    'date_bank_company' => $request->get('date_bank_company')[$i],
                                ]);
                            }
                        } catch (\Exception $e) {
                        }
                    }

                    if (!empty($customer_securing)) {
                        \DB::table('customer_securing')
                            ->where('customer_id', $request->id)
                            ->delete();
                        try {
                            $securing = count(collect($request)->get('name_securing_company'));
                            for ($i = 0; $i <= $securing; $i++) {
                                \DB::table('customer_securing')->insert([
                                    'customer_id' => $request->id,
                                    'name_securing_company' => $request->get('name_securing_company')[$i],
                                    'date_securing_company' => $request->get('date_securing_company')[$i],
                                ]);
                            }
                        } catch (\Exception $e) {
                        }
                    } else {
                        try {
                            $securing = count(collect($request)->get('name_securing_company'));
                            for ($i = 0; $i <= $securing; $i++) {
                                \DB::table('customer_securing')->insert([
                                    'customer_id' => $request->id,
                                    'name_securing_company' => $request->get('name_securing_company')[$i],
                                    'date_securing_company' => $request->get('date_securing_company')[$i],
                                ]);
                            }
                        } catch (\Exception $e) {
                        }
                    }

                    if (!empty($customer_documents)) {
                        \DB::table('customer_documents')
                            ->where('customer_id', $request->id)
                            ->update([
                                'certificate_documents_company' => $certificate_documents_company,
                                'cart_documents_company' => $cart_documents_company,
                                'activity_documents_company' => $activity_documents_company,
                                'store_documents_company' => $store_documents_company,
                                'ownership_documents_company' => $ownership_documents_company,
                                'established_documents_company' => $established_documents_company,
                                'sstore_documents_company' => $sstore_documents_company,
                                'pstore_documents_company' => $pstore_documents_company,
                                'final_documents_company' => $final_documents_company,
                            ]);
                    } else {
                        \DB::table('customer_documents')
                            ->insert([
                                'customer_id' => $request->id,
                                'certificate_documents_company' => $certificate_documents_company,
                                'cart_documents_company' => $cart_documents_company,
                                'activity_documents_company' => $activity_documents_company,
                                'store_documents_company' => $store_documents_company,
                                'ownership_documents_company' => $ownership_documents_company,
                                'established_documents_company' => $established_documents_company,
                                'sstore_documents_company' => $sstore_documents_company,
                                'pstore_documents_company' => $pstore_documents_company,
                                'final_documents_company' => $final_documents_company,
                            ]);
                    }

                    if (!empty($company_personal)) {
                        \DB::table('company_personal')
                            ->where('customer_id', $request->id)
                            ->delete();
                        try {
                            $size = count(collect($request)->get('per_side_company'));
                            for ($i = 0; $i <= $size; $i++) {
                                \DB::table('company_personal')->insert([
                                    'customer_id' => $request->id,
                                    'per_side_company' => $request->get('per_side_company')[$i],
                                    'per_sex_company' => $request->get('per_sex_company')[$i],
                                    'per_title_company' => $request->get('per_title_company')[$i],
                                    'per_name_company' => $request->get('per_name_company')[$i],
                                    'per_phone_company' => $request->get('per_phone_company')[$i],
                                    'per_inside_company' => $request->get('per_inside_company')[$i],
                                    'per_email_company' => $request->get('per_email_company')[$i],
                                    'per_tel_company_company' => $request->get('per_tel_company_company')[$i],
                                ]);
                            }
                            return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
                        } catch (\Exception $e) {
                            return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
                        }

                    } else {
                        try {
                            $size = count(collect($request)->get('per_side_company'));
                            for ($i = 0; $i <= $size; $i++) {
                                \DB::table('company_personal')->insert([
                                    'customer_id' => $request->id,
                                    'per_side_company' => $request->get('per_side_company')[$i],
                                    'per_sex_company' => $request->get('per_sex_company')[$i],
                                    'per_title_company' => $request->get('per_title_company')[$i],
                                    'per_name_company' => $request->get('per_name_company')[$i],
                                    'per_phone_company' => $request->get('per_phone_company')[$i],
                                    'per_inside_company' => $request->get('per_inside_company')[$i],
                                    'per_email_company' => $request->get('per_email_company')[$i],
                                    'per_tel_company_company' => $request->get('per_tel_company_company')[$i],
                                ]);
                            }
                            return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
                        } catch (\Exception $e) {
                            return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
                        }
                    }
                } else
                    \DB::table('customer_personal')
                        ->where('customer_id', $request->id)
                        ->update([
                            'sex' => $request->sex_personel,
                            'date_personel' => $request->date_personel,
                            'codemeli_personel' => $request->codemeli_personel,
                            'tel_personel' => $request->tel_personel,
                            'phone_personel' => $request->phone_personel,
                            'email_personel' => $request->email_personel,
                            'adders_personel' => $request->adders_personel,
                            'text_personel' => $request->text_personel,
                            'fax_personel' => $request->fax_personel,
                        ]);
            } catch (Exception $e) {
                return Response::json(['errors' => 'error']);
            }
            return response()->json(['success' => 'مشخصات مشتری با موفقیت در سیستم ثبت شد']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * حذف اطلاعات مشتریان
     */
    public function delete($id)
    {
        $post = Customer::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * فیلتر کردن مشتریان و نمایش صفحه مربوط وارد کردن اطلاعات
     */
    public function filter(Request $request)
    {
        $type = \DB::table("type_customers")
            ->where("id", $request->type)
            ->pluck("type");
        return response()->json($type);

    }

    /**
     * حذف فایل شناسنامه
     */
    public function deleteFileCertificate($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->certificate_documents_company)) {
            unlink($image_path->certificate_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'certificate_documents_company' => null,
            ]);


        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);
    }

    /**
     * حذف فایل کارت ملی
     */
    public function deleteFileCart($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->cart_documents_company)) {
            unlink($image_path->cart_documents_company);
        }

        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'cart_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);

    }

    /**
     * حذف فایل فعالیت ها
     */
    public function deleteFileActivity($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->activity_documents_company)) {
            unlink($image_path->activity_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'activity_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);
    }

    /**
     * حذف مدارک مشتری به صورت ایجکسی
     */
    public function deleteFileStore($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->store_documents_company)) {
            unlink($image_path->store_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'store_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);
    }

    /**
     * حذف مدارک مشتری به صورت ایجکسی
     */
    public function deleteFileOwnership($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->ownership_documents_company)) {
            unlink($image_path->ownership_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'ownership_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);

    }

    /**
     * حذف مدارک مشتری به صورت ایجکسی
     */
    public function deleteFileEstablished($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->established_documents_company)) {
            unlink($image_path->established_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'established_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);

    }

    /**
     * حذف مدارک مشتری به صورت ایجکسی
     */
    public function deleteFileSstore($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->sstore_documents_company)) {
            unlink($image_path->sstore_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'sstore_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);

    }

    /**
     * حذف مدارک مشتری به صورت ایجکسی
     */
    public function deleteFilePstore($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->pstore_documents_company)) {
            unlink($image_path->pstore_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'pstore_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);

    }


    public function detaillist(Customer $id)
    {
        $areass = Areas::all();
        $country = \DB::table('country')
            ->where('country_id', $id->country)
            ->first();
        $city = \DB::table('zone')
            ->where('zone_id', $id->city)
            ->first();
        $user = User::where('id', $id->expert)->first();
        $type = \DB::table('type_customers')
            ->where('id', $id->type)->first();

        if ($type->type == 2) {
            $personel = \DB::table('customer_personal')
                ->where('customer_id', $id->id)->first();
            return view('Customer.detail',
                compact('id', 'country', 'areass', 'city', 'user', 'personel', 'type'));
        } else {
            $customer = \DB::table('customer_company')
                ->where('customer_id', $id->id)
                ->first();
            $work = \DB::table('customer_work')
                ->where('customer_id', $id->id)
                ->first();
            $banks = \DB::table('customer_bank')
                ->where('customer_id', $id->id)
                ->get();

            $securings = \DB::table('customer_securing')
                ->where('customer_id', $id->id)
                ->get();

            $companys = \DB::table('company_personal')
                ->where('customer_id', $id->id)
                ->get();


            return view('Customer.detail',
                compact('id', 'country', 'city', 'user',
                    'work', 'banks', 'securings', 'companys',
                    'type', 'customer', 'areass'));

        }


    }

    /**
     * حذف مدارک مشتری به صورت ایجکسی
     */
    public function deleteFileFinal($id)
    {
        $image_path = \DB::table('customer_documents')
            ->where('customer_id', $id)->first();
        if (file_exists($image_path->final_documents_company)) {
            unlink($image_path->final_documents_company);
        }
        \DB::table('customer_documents')
            ->where('customer_id', $id)
            ->update([
                'final_documents_company' => null,
            ]);
        return response()->json(['success' => 'فایل مشتری با موفقیت در سیستم ثبت شد']);

    }


    public function checkcity(Request $request)
    {
        $state = \DB::table('zone')
            ->where('country_id', $request->commodity_id)->get();
        return response()->json($state);

    }

    public function checkstate(Request $request)
    {
        $statee = Areas::
        where('state_id', $request->commodity_id)->get();
        return response()->json($statee);

    }

    /**
     * دکمه عملیات موجود در دیتا تیبل مشتریان
     */
    public function actions($row)
    {
        $btn = '<a href="' . route('admin.customers.update', $row->id) . '">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . '<a href="' . route('admin.customers.list.detail', $row->id) . '">
                       <i class="fa fa-eye fa-lg" title="جزییات اطلاعات مشتری"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        return $btn;

    }

}
