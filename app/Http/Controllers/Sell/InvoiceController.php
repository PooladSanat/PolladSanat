<?php

namespace App\Http\Controllers\Sell;

use App\Bank;
use App\BarnsProduct;
use App\Color;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\ModelProduct;
use App\Product;
use App\ProductTitle;
use App\Role;
use App\Scheduling;
use App\SelectStore;
use App\Setting;
use App\User;
use Carbon\Carbon;
use DB;
use Gate;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Response;
use Symfony\Component\VarDumper\Cloner\Data;
use Validator;
use View;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{


    public function index(Request $request)
    {

        $id = auth()->user()->id;
        $role_id = \DB::table('role_user')
            ->where('user_id', $id)->first();
        $role = DB::table('roles')
            ->where('id', $role_id->role_id)
            ->first();
        $invoices = \DB::table('invoice_customer')->get();
        $banks = Bank::where('status', 1)->get();
        $selectstores = SelectStore::where('status', 1)->get();
        $users = User::all();
        $invoicePrints = \DB::table('invoice_print')
            ->get();

        if ($role->name == "مدیریت" or $role->name == "Admin" or $role->name == "کارشناس فروش و مالی") {
            if ($request->ajax()) {
                $data = Invoice::where('state', '!=', 3)
                    ->where('state', '!=', 5)
                    ->orderBy('id', 'desc')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('invoiceNumber', function ($row) {
                        $invoiceNumber = $row->invoiceNumber;
                        $btn = '<a href="' . route('admin.invoice.detail', $row->id) . '">
                     ' . $invoiceNumber . '
                      </a>';
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
                        return $created_at;
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->state == 0) {
                            return 'در انتظار تایید فروشنده';
                        } elseif ($row->state == 1) {
                            return 'در انتظار تایید مدیریت';
                        } elseif ($row->state == 2) {
                            return 'تکمیل شده';
                        } elseif ($row->state == 3) {
                            return 'تایید شده';
                        } elseif ($row->state == 4) {
                            return 'تایید شده';
                        }
                    })
                    ->addColumn('user_id', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('customer_id', function ($row) {
                        $btn = '<a href="' . route('admin.customers.list.detail', $row->customer_id) . '">
                     ' . $row->customer->name . '
                      </a>';
                        return $btn;

                    })
                    ->addColumn('number_sell', function ($row) {
                        return number_format($row->number_sell) . 'عدد';
                    })
                    ->addColumn('sum_sell', function ($row) {
                        return number_format($row->sum_sell) . 'ریال';
                    })
                    ->addColumn('price_sell', function ($row) {
                        return number_format($row->totalfinal) . 'ریال';
                    })
                    ->addColumn('paymentMethod', function ($row) {

                        return $row->paymentMethod;
                    })
                    ->addColumn('invoiceType', function ($row) {
                        if ($row->invoiceType == 1) {
                            return 'رسمی';

                        } else
                            return 'غیر رسمی';
                    })
                    ->addColumn('action', function ($row) {
                        return $this->actions($row);
                    })
                    ->rawColumns(['action', 'invoiceNumber', 'customer_id'])
                    ->make(true);
            }
            return view('sell.list', compact('invoices', 'invoicePrints', 'banks', 'users', 'selectstores'));

        }
        if ($role->name == "کارشناس فروش") {
            if ($request->ajax()) {
                $data = Invoice::where('user_id', $id)
                    ->where('state', '!=', 3)
                    ->where('state', '!=', 5)
                    ->orderBy('id', 'desc')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('invoiceNumber', function ($row) {
                        $invoiceNumber = $row->invoiceNumber;
                        $btn = '<a href="' . route('admin.invoice.detail', $row->id) . '">
                     ' . $invoiceNumber . '
                      </a>';
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
                        return $created_at;
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->state == 0) {
                            return 'در انتظار بررسی سوابق مالی';
                        } elseif ($row->state == 1) {
                            return 'در انتظار تایید مدیریت';
                        } elseif ($row->state == 2) {
                            return 'تکمیل شده';
                        } elseif ($row->state == 3) {
                            return 'تایید شده';
                        } elseif ($row->state == 4) {
                            return 'تایید شده';
                        }
                    })
                    ->addColumn('user_id', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('customer_id', function ($row) {
                        $btn = '<a href="' . route('admin.customers.list.detail', $row->customer_id) . '">
                     ' . $row->customer->name . '
                      </a>';
                        return $btn;

                    })
                    ->addColumn('number_sell', function ($row) {
                        return number_format($row->number_sell) . 'عدد';
                    })
                    ->addColumn('sum_sell', function ($row) {
                        return number_format($row->sum_sell) . 'ریال';
                    })
                    ->addColumn('price_sell', function ($row) {
                        return number_format($row->totalfinal) . 'ریال';
                    })
                    ->addColumn('paymentMethod', function ($row) {

                        return $row->paymentMethod;
                    })
                    ->addColumn('invoiceType', function ($row) {
                        if ($row->invoiceType == 1) {
                            return 'رسمی';

                        } else
                            return 'غیر رسمی';
                    })
                    ->addColumn('action', function ($row) {
                        return $this->actions($row);
                    })
                    ->rawColumns(['action', 'invoiceNumber', 'customer_id'])
                    ->make(true);
            }
            return view('sell.list', compact('invoices', 'invoicePrints', 'banks', 'users', 'selectstores'));

        }


    }

    public function trash(Request $request)
    {
        $id = auth()->user()->id;
        $role_id = \DB::table('role_user')
            ->where('user_id', $id)->first();
        $role = DB::table('roles')
            ->where('id', $role_id->role_id)
            ->first();
        $invoices = \DB::table('invoice_customer')->get();

        if ($role->name == "مدیریت" or $role->name == "Admin" or $role->name == "کارشناس فروش و مالی") {
            if (request()->ajax()) {
                if (!empty($request->from_date)) {
                    $data = Invoice::onlyTrashed()
                        ->whereBetween('date', array($request->from_date, $request->to_date))
                        ->orderBy('create', 'DESC')->get();
                } else {
                    $data = Invoice::onlyTrashed()->orderBy('create', 'DESC')->get();
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('invoiceNumber', function ($row) {
                        $invoiceNumber = $row->invoiceNumber;
                        $btn = '<a href="' . route('admin.invoice.detailTrash', $row->id) . '">
                     ' . $invoiceNumber . '
                      </a>';
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
                        return $created_at;
                    })
                    ->addColumn('checkbox', function ($row) {
                        $btn = ' <input type="checkbox" id="checkbox"
                        name="student_checkbox[]"
                        value=' . $row->id . '
                       class="student_checkbox">';

                        return $btn;


                    })
                    ->addColumn('status', function ($row) {

                        return 'تایید نشده';

                    })
                    ->addColumn('user_id', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('customer_id', function ($row) {
                        return $row->customer->name;
                    })
                    ->addColumn('number_sell', function ($row) {
                        return number_format($row->number_sell);
                    })
                    ->addColumn('sum_sell', function ($row) {
                        return number_format($row->sum_sell);
                    })
                    ->addColumn('price_sell', function ($row) {
                        return number_format($row->price_sell);
                    })
                    ->addColumn('paymentMethod', function ($row) {
                        if ($row->paymentMethod == "0") {
                            return 'نقدی';
                        } else
                            return $row->paymentMethod;
                    })
                    ->addColumn('invoiceType', function ($row) {
                        if ($row->invoiceType == 1) {
                            return 'رسمی';

                        } else
                            return 'غیر رسمی';
                    })
                    ->addColumn('action', function ($row) {
                        return $this->action($row);
                    })
                    ->rawColumns(['action', 'invoiceNumber', 'checkbox'])
                    ->make(true);
            }
            return view('sell.trash', compact('invoices'));
        }
        if ($role->name == "کارشناس فروش") {
            if (request()->ajax()) {
                if (!empty($request->from_date)) {
                    $data = Invoice::onlyTrashed()
                        ->where('user_id', auth()->user()->id)
                        ->whereBetween('date', array($request->from_date, $request->to_date))
                        ->get();
                } else {
                    $data = Invoice::onlyTrashed()->where('user_id', auth()->user()->id)->get();
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('invoiceNumber', function ($row) {
                        $invoiceNumber = $row->invoiceNumber;
                        $btn = '<a href="' . route('admin.invoice.detailTrash', $row->id) . '">
                     ' . $invoiceNumber . '
                      </a>';
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
                        return $created_at;
                    })
                    ->addColumn('checkbox', function ($row) {
                        $btn = ' <input type="checkbox" id="checkbox"
                        name="student_checkbox[]"
                        value=' . $row->id . '
                       class="student_checkbox">';

                        return $btn;


                    })
                    ->addColumn('status', function ($row) {

                        return 'تایید نشده';

                    })
                    ->addColumn('user_id', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('customer_id', function ($row) {
                        return $row->customer->name;
                    })
                    ->addColumn('number_sell', function ($row) {
                        return number_format($row->number_sell);
                    })
                    ->addColumn('sum_sell', function ($row) {
                        return number_format($row->sum_sell);
                    })
                    ->addColumn('price_sell', function ($row) {
                        return number_format($row->price_sell);
                    })
                    ->addColumn('paymentMethod', function ($row) {
                        if ($row->paymentMethod == "0") {
                            return 'نقدی';
                        } else
                            return $row->paymentMethod;
                    })
                    ->addColumn('invoiceType', function ($row) {
                        if ($row->invoiceType == 1) {
                            return 'رسمی';

                        } else
                            return 'غیر رسمی';
                    })
                    ->addColumn('action', function ($row) {
                        return $this->action($row);
                    })
                    ->rawColumns(['action', 'invoiceNumber', 'checkbox'])
                    ->make(true);
            }
            return view('sell.trash', compact('invoices'));

        }


//        $id = auth()->user()->id;
//        $role = \DB::table('role_user')
//            ->where('user_id', $id)->first();
//        $invoices = \DB::table('invoice_customer')->get();
//        if ($role->role_id == 1) {
//            if ($request->ajax()) {
//                $data = Invoice::onlyTrashed()->get();
//                return Datatables::of($data)
//                    ->addIndexColumn()
//                    ->addColumn('invoiceNumber', function ($row) {
//                        $invoiceNumber = $row->invoiceNumber;
//                        $btn = '<a href="' . route('admin.invoice.detailTrash', $row->id) . '">
//                     ' . $invoiceNumber . '
//                      </a>';
//                        return $btn;
//                    })
//                    ->addColumn('created_at', function ($row) {
//                        $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
//                        return $created_at;
//                    })
//                    ->addColumn('checkbox', function ($row) {
//                        $btn = ' <input type="checkbox" id="checkbox"
//                        name="student_checkbox[]"
//                        value=' . $row->id . '
//                       class="student_checkbox">';
//
//                        return $btn;
//
//
//                    })
//                    ->addColumn('status', function ($row) {
//                        if ($row->state == 0) {
//                            return 'در حال تکمیل';
//                        } elseif ($row->state == 1) {
//                            return 'تایید مشتری';
//                        } elseif ($row->state == 2) {
//                            return 'تایید نشده';
//                        }
//                    })
//                    ->addColumn('user_id', function ($row) {
//                        return $row->user->name;
//                    })
//                    ->addColumn('customer_id', function ($row) {
//                        return $row->customer->name;
//                    })
//                    ->addColumn('number_sell', function ($row) {
//                        return number_format($row->number_sell) . 'عدد';
//                    })
//                    ->addColumn('sum_sell', function ($row) {
//                        return number_format($row->sum_sell) . 'ریال';
//                    })
//                    ->addColumn('price_sell', function ($row) {
//                        return number_format($row->price_sell) . 'ریال';
//                    })
//                    ->addColumn('paymentMethod', function ($row) {
//                        if ($row->paymentMethod == "0") {
//                            return 'نقدی';
//                        } else
//                            return $row->paymentMethod . 'روز ';
//                    })
//                    ->addColumn('invoiceType', function ($row) {
//                        if ($row->invoiceType == 1) {
//                            return 'رسمی';
//
//                        } else
//                            return 'غیر رسمی';
//                    })
//                    ->addColumn('action', function ($row) {
//                        return $this->action($row);
//                    })
//                    ->rawColumns(['action', 'invoiceNumber', 'checkbox'])
//                    ->make(true);
//            }
//            return view('sell.trash', compact('invoices'));
//
//        } elseif ($role->role_id == 3) {
//            if ($request->ajax()) {
//                $data = Invoice::onlyTrashed()->get();
//                return Datatables::of($data)
//                    ->addIndexColumn()
//                    ->addColumn('invoiceNumber', function ($row) {
//                        $invoiceNumber = $row->invoiceNumber;
//                        $btn = '<a href="' . route('admin.invoice.detailTrash', $row->id) . '">
//                     ' . $invoiceNumber . '
//                      </a>';
//                        return $btn;
//                    })
//                    ->addColumn('created_at', function ($row) {
//                        $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
//                        return $created_at;
//                    })
//                    ->addColumn('status', function ($row) {
//                        if ($row->state == 0) {
//                            return 'در حال تکمیل';
//                        } elseif ($row->state == 1) {
//                            return 'تایید مشتری';
//                        } elseif ($row->state == 2) {
//                            return 'تایید نشده';
//                        }
//                    })
//                    ->addColumn('user_id', function ($row) {
//                        return $row->user->name;
//                    })
//                    ->addColumn('customer_id', function ($row) {
//                        return $row->customer->name;
//                    })
//                    ->addColumn('number_sell', function ($row) {
//                        return number_format($row->number_sell) . 'عدد';
//                    })
//                    ->addColumn('sum_sell', function ($row) {
//                        return number_format($row->sum_sell) . 'ریال';
//                    })
//                    ->addColumn('price_sell', function ($row) {
//                        return number_format($row->price_sell) . 'ریال';
//                    })
//                    ->addColumn('paymentMethod', function ($row) {
//                        if ($row->paymentMethod == "0") {
//                            return 'نقدی';
//                        } else
//                            return $row->paymentMethod . 'روز ';
//                    })
//                    ->addColumn('invoiceType', function ($row) {
//                        if ($row->invoiceType == 1) {
//                            return 'رسمی';
//
//                        } else
//                            return 'غیر رسمی';
//                    })
//                    ->addColumn('action', function ($row) {
//                        return $this->action($row);
//                    })
//                    ->rawColumns(['action', 'invoiceNumber'])
//                    ->make(true);
//            }
//            return view('sell.trash', compact('invoices'));
//        }
//
//        if ($request->ajax()) {
//            $data = Invoice::where('user_id', auth()->user()->id)->onlyTrashed()->get();
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('invoiceNumber', function ($row) {
//                    $invoiceNumber = $row->invoiceNumber;
//                    $btn = '<a href="' . route('admin.invoice.detailTrash', $row->id) . '">
//                     ' . $invoiceNumber . '
//                      </a>';
//                    return $btn;
//                })
//                ->addColumn('created_at', function ($row) {
//                    $created_at = Jalalian::forge($row->created_at)->format('Y/m/d');
//                    return $created_at;
//                })
//                ->addColumn('status', function ($row) {
//                    if ($row->state == 0) {
//                        return 'در حال تکمیل';
//                    } elseif ($row->state == 1) {
//                        return 'تایید مشتری';
//                    } elseif ($row->state == 2) {
//                        return 'تایید نشده';
//                    }
//                })
//                ->addColumn('user_id', function ($row) {
//                    return $row->user->name;
//                })
//                ->addColumn('customer_id', function ($row) {
//                    return $row->customer->name;
//                })
//                ->addColumn('number_sell', function ($row) {
//                    return number_format($row->number_sell) . 'عدد';
//                })
//                ->addColumn('sum_sell', function ($row) {
//                    return number_format($row->sum_sell) . 'ریال';
//                })
//                ->addColumn('price_sell', function ($row) {
//                    return number_format($row->price_sell) . 'ریال';
//                })
//                ->addColumn('paymentMethod', function ($row) {
//                    if ($row->paymentMethod == "0") {
//                        return 'نقدی';
//                    } else
//                        return $row->paymentMethod . 'روز ';
//                })
//                ->addColumn('invoiceType', function ($row) {
//                    if ($row->invoiceType == 1) {
//                        return 'رسمی';
//
//                    } else
//                        return 'غیر رسمی';
//                })
//                ->addColumn('action', function ($row) {
//                    return $this->action($row);
//                })
//                ->rawColumns(['action', 'invoiceNumber'])
//                ->make(true);
//        }
//        return view('sell.trash', compact('invoices'));

    }

    public function UpdateConfirm($id)
    {

        $product = \DB::table('invoice_customer')->where('invoice_id', $id)->first();
        return response()->json($product);
    }

    public function detail(Invoice $id)
    {


        $users = User::all();
        $customers = Customer::all();
        $colors = Color::all();
        $products = Product::all();
        $details = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();

        $weight = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->sum('weight');
        $taxAmount = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->sum('taxAmount');

        return view('sell.detail', compact('details', 'id',
            'colors', 'customers', 'users', 'products', 'weight', 'taxAmount'));

    }

    public function detailTrash($id)
    {

        $invoices = Invoice::withTrashed()->find($id);

        $users = User::all();
        $customers = Customer::all();
        $colors = Color::all();
        $products = Product::all();
        $details = \DB::table('invoice_product')
            ->where('invoice_id', $invoices->id)
            ->get();

        $weight = \DB::table('invoice_product')
            ->where('invoice_id', $invoices->id)
            ->sum('weight');
        $taxAmount = \DB::table('invoice_product')
            ->where('invoice_id', $invoices->id)
            ->sum('taxAmount');


        return view('sell.detailTrash', compact('invoices', 'details', 'id', 'colors',
            'customers', 'users', 'products', 'weight', 'taxAmount'));

    }

    public function RestoreDelete($id)
    {
        $restore = Invoice::withTrashed()->find($id);
        DB::beginTransaction();
        try {
            $success = $restore->restore();
            if ($success) {
                $restore->update([
                    'state' => 0,
                ]);
                \DB::table('invoice_delete')
                    ->where('invoice_id', $restore->id)
                    ->delete();
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function wizard()
    {
        $users = User::all();
        $customers = Customer::all();
        $products = Product::all();
        $colors = Color::all();
        $setting = Setting::first();
        $modelProducts = ModelProduct::all();
        return view('sell.wizard', compact('users', 'customers',
            'products', 'colors', 'modelProducts', 'setting'));

    }

    public function update(Invoice $id)
    {

        $users = User::all();
        $customers = Customer::all();
        $products = Product::all();
        $colors = Color::all();
        $setting = Setting::first();
        $modelProducts = ModelProduct::all();
        $invoice_products = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();
        return view('sell.update', compact('users', 'customers',
            'products', 'colors', 'modelProducts', 'setting', 'id', 'invoice_products'));

    }

    public function updateproduct(Invoice $id)
    {

        $users = User::all();
        $customers = Customer::all();
        $products = Product::all();
        $colors = Color::all();
        $setting = Setting::first();
        $modelProducts = ModelProduct::all();
        $invoice_products = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();
        return view('sell.successedit', compact('users', 'customers',
            'products', 'colors', 'modelProducts', 'setting', 'id', 'invoice_products'));

    }

    public function edit(Request $request)
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
        $tax = (int)$request->price_full - (int)$request->price_selll;
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $invoice = Invoice::find($request->id)->update([
                    'user_id' => $request->user_id,
                    'customer_id' => $request->customer_id,
                    'invoiceType' => $request->InvoiceType,
                    'paymentMethod' => $request->paymentMethod,
                    'sum_sell' => $request->sum_selll,
                    'number_sell' => $request->number_selll,
                    'tax' => $tax,
                    'takhfif' => $request->takhfif,
                    'expenses' => $request->expenses,
                    'price_sell' => $request->price_selll,
                    'Carry' => $request->Carry,
                    'ta' => $request->taa,
                    'totalfinal' => $request->price_f,
                    'ma' => $request->ma,
                    'description' => $request->description,
                    'create' => $this->convert2english($request->created),
                ]);
                try {
                    \DB::table('invoice_product')
                        ->where('invoice_id', $request->id)
                        ->delete();
                    $number = count(collect($request)->get('product'));
                    for ($i = 0; $i <= $number; $i++) {
                        \DB::table('invoice_product')->insert([
                            'invoice_id' => $request->id,
                            'user_id' => $request->user_id,
                            'product_id' => $request->get('product')[$i],
                            'color_id' => $request->get('color')[$i],
                            'salesNumber' => $request->get('number')[$i],
                            'salesPrice' => $request->get('sell')[$i],
                            'leftover' => $request->get('number')[$i],
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

    public function ToList(Request $request)
    {

        $invoice_product = DB::table('invoice_product')
            ->whereIn('id', $request->id)
            ->get();

        return response()->json(['details' => $invoice_product]);

    }

    public function editproduct(Request $request)
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
        if (empty($request->product)) {
            DB::beginTransaction();
            try {
                Invoice::where('id', $request->id)->forceDelete();
                \DB::table('invoice_product')
                    ->where('invoice_id', $request->id)
                    ->delete();
                DB::commit();
                return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);
            } catch (Exception $exception) {
                DB::rollBack();
            }
        }
        $tax = (int)$request->price_full - (int)$request->price_selll;
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $invoice = Invoice::find($request->id)->update([
                    'user_id' => $request->user_id,
                    'customer_id' => $request->customer_id,
                    'invoiceType' => $request->InvoiceType,
                    'paymentMethod' => $request->paymentMethod,
                    'sum_sell' => $request->sum_selll,
                    'number_sell' => $request->number_selll,
                    'tax' => $tax,
                    'takhfif' => $request->takhfif,
                    'expenses' => $request->expenses,
                    'price_sell' => $request->price_selll,
                    'Carry' => $request->Carry,
                    'ta' => $request->taa,
                    'totalfinal' => $request->price_f,
                    'ma' => $request->ma,
                    'create' => $this->convert2english($request->created),
                    'description' => $request->description,
                ]);
                try {
                    \DB::table('invoice_product')
                        ->where('invoice_id', $request->id)
                        ->delete();
                    $number = count(collect($request)->get('product'));
                    for ($i = 0; $i <= $number; $i++) {
                        \DB::table('invoice_product')->insert([
                            'invoice_id' => $request->id,
                            'product_id' => $request->get('product')[$i],
                            'color_id' => $request->get('color')[$i],
                            'salesNumber' => $request->get('number')[$i],
                            'salesPrice' => $request->get('sell')[$i],
                            'sumTotal' => $request->get('Price_Sell')[$i],
                            'weight' => $request->get('Weight')[$i],
                            'taxAmount' => $request->get('Tax')[$i],
                            'leftover' => $request->get('number')[$i],
                            'state' => 1,
                            'user_id' => $request->user_id,
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

    public function store(Request $request)
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
                    'description' => $request->description,
                    'sign' => $request->user_id,
                    'create' => $this->convert2english($request->created),
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

    public function CustomerValidate($id)
    {
        Invoice::where('id', $id)->update([
            'state' => 1,
        ]);
        return response()->json(['success' => 'success']);

    }

    public function CustomerMany($id)
    {
        $customer_id = Invoice::where('id', $id)->first();

        $product = \DB::table('customer_history_payment')->where('customer_id', $customer_id->customer_id)->first();
        return response()->json($product);

    }

    public function savetolist(Request $request)
    {
        $created_at = Carbon::now();

        $count = count($request->numff);
        for ($i = 0; $i < $count; $i++) {
            $invoice_product = DB::table('invoice_product')
                ->where('id', $request->numff[$i])
                ->first();
            $user = DB::table('invoices')
                ->where('id', $invoice_product->invoice_id)
                ->first();

            DB::table('detail_invoice_list')->insert([
                'invoice_id' => $invoice_product->invoice_id,
                'user_id' => $user->user_id,
                'invoice_product' => $invoice_product->id,
                'number' => $request->sum_ss[$i],
                'date' => $request->date_mm[$i],
                'Priority' => $request->olavitt[$i],
                'product_id' => $invoice_product->product_id,
                'color_id' => $invoice_product->color_id,
                'created_at' => $created_at,
            ]);

        }

        return response()->json(['success' => 'success']);

    }

    public function print(Request $request)
    {

        DB::beginTransaction();
        try {
            \DB::table('invoice_print_date')
                ->updateOrInsert(['invoice_id' => $request->id],
                    [
                        'selectstores_id' => $request->selectstores,
                        'bank_id' => $request->name_bank,
                        'date' => $request->date,
                        'time' => $request->timee,
                        'description' => $request->description,
                    ]);
            Invoice::where('id', $request->id)->update([
                'selectstores' => $request->selectstores,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        $bank = Bank::where('id', $request->name_bank)->first();
        $selectstore = SelectStore::where('id', $request->selectstores)->first();
        $id = Invoice::find($request->id);
        $customer = Customer::where('id', $id->customer_id)->first();
        $products = Product::all();
        $colors = Color::all();
        $date = $request->date;
        $time = $request->timee;
        $description = $request->description;
        $invoice_products = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();
        $invoice = Invoice::where('id', $id->id)->first();
        $user_id = User::where('id', $invoice->sign)->first();

        $view = View::make('sell.print.list',
            compact('id', 'colors', 'customer',
                'products', 'invoice_products', 'bank', 'description',
                'time', 'selectstore', 'date', 'user_id'));
        return $view->render();


    }

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'HowConfirm' => 'required',
        ], [

            'date.required' => 'لطفا تاریخ را وارد کنید',
            'HowConfirm.required' => 'لطفا نحوه تایید را انتخاب کنید',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $invoice_customer = \DB::table('invoice_customer')
                    ->updateOrInsert(['invoice_id' => $request->id_in],
                        [
                            'date' => $this->convert2english($request->date),
                            'HowConfirm' => $request->HowConfirm,
                            'file' => $request->file,
                            'description' => $request->description,
                            'created_at' => date('Y/m/d'),
                        ]);
                Invoice::find($request->id_in)->update([
                    'state' => 3,
                ]);
                DB::table('invoice_product')
                    ->where('invoice_id', $request->id_in)
                    ->update([
                        'state' => 1,
                    ]);
                DB::commit();
            } catch (Exception $exception) {
                DB::rollBack();
            }
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);

    }

    public function ValidateStore(Request $request)
    {


        $id = Invoice::where('id', $request->customer_id)->first();

        DB::beginTransaction();
        try {
            $success = \DB::table('customer_validation_payment')
                ->updateOrInsert(['customer_id' => $id->customer_id],
                    [
                        'Creditceiling' => $request->Creditceiling,
                        'Openceiling' => $request->Openceiling,
                        'Yearcount' => $request->Yearcount,
                        'yearAgoCount' => $request->yearAgoCount,
                        'Yearturnover' => $request->Yearturnover,
                        'lastYearturnover' => $request->lastYearturnover,
                        'user_id' => auth()->user()->id,
                        'Checkback' => $request->Checkback,
                        'Checkbackintheflow' => $request->Checkbackintheflow,
                        'accountbalance' => $request->accountbalance,
                        'Averagetimedelay' => $request->Averagetimedelay,
                        'Futurefactors' => $request->Futurefactors,
                        'Receiveddocuments' => $request->Receiveddocuments,
                        'Openaccountbalance' => $request->Openaccountbalance,
                        'paymentmethod' => $request->paymentmethod,
                        'description' => $request->description,
                        'created_at' => date('Y/m/d'),
                    ]);
            Invoice::where('id', $request->customer_id)->update([
                'state' => 1,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function ManyStore(Request $request)
    {

        $id = Invoice::where('id', $request->many_id)->first();
        $success = \DB::table('customer_history_payment')
            ->updateOrInsert(['customer_id' => $id->customer_id],
                [
                    'user_id' => auth()->user()->id,
                    'Checkback' => $request->Checkback,
                    'Checkbackintheflow' => $request->Checkbackintheflow,
                    'accountbalance' => $request->accountbalance,
                    'Averagetimedelay' => $request->Averagetimedelay,
                    'Futurefactors' => $request->Futurefactors,
                    'Receiveddocuments' => $request->Receiveddocuments,
                    'Openaccountbalance' => $request->Openaccountbalance,
                    'paymentmethod' => $request->paymentmethod,
                    'description' => $request->description,
                    'created_at' => date('Y/m/d'),
                ]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function TrashAdmin($id)
    {
        $product = \DB::table('invoice_delete')
            ->where('invoice_id', $id)->first();
        return response()->json($product);

    }

    public function delete(Request $request)
    {

        DB::beginTransaction();
        try {
            if ($request->step == 1) {
                Invoice::find($request->id_delete)->update([
                    'state' => 0,
                ]);
            } elseif ($request->step == 2) {
                Invoice::find($request->id_delete)->update([
                    'state' => 1,
                ]);
            } else {
                \DB::table('invoice_delete')->insert([
                    'invoice_id' => $request->id_delete,
                    'cancellation' => $request->cancellation,
                    'description' => $request->description,
                ]);
                $update = Invoice::find($request->id_delete)->update([
                    'state' => 5,
                    'dele' => 1,
                ]);
                if ($update) {
                    $delete_soft = Invoice::find($request->id_delete);
                    $delete_soft->delete();
                }
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function AdminDelete($id)
    {

        $delete = Invoice::withTrashed()->find($id);
        DB::beginTransaction();
        try {
            $delete->forceDelete();
            DB::table('invoice_product')
                ->where('invoice_id', $id)
                ->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function ShowDetail($id)
    {
        $bank = Bank::find($id);
        return response()->json($bank);

    }

    public function PrintDetail(Invoice $id)
    {
        $payments = DB::table('payments')
            ->whereNotNull('invoice_id')
            ->get();
        $user_ids = User::where('id', $id->user_id)->first();
        $invoices_backs = DB::table('factors')
            ->where('customer_id', $id->customer_id)
            ->orderBy('date', 'desc')
            ->get();

        $factors = DB::table('factors')
            ->where('status', 0)
            ->where('end', null)
            ->where('customer_id', $id->customer_id)
            ->orderBy('date', 'desc')
            ->get();

        $dataa = \DB::table('clearing')
            ->where('customer_id', $id->customer_id)
            ->orderBy('date', 'desc')
            ->get();


        $customer_validation_payment = \DB::table('customer_validation_payment')
            ->where('customer_id', $id->customer_id)
            ->first();
        if (!empty($customer_validation_payment->user_id)) {
            $user_id = $customer_validation_payment->user_id;
        } else
            $user_id = null;
        $admin_invoice = \DB::table('admin_invoice')
            ->where('invoice_id', $id->id)
            ->first();
        if (!empty($admin_invoice->user_id)) {
            $user_id_c = $admin_invoice->user_id;
        } else
            $user_id_c = null;

//        $customer_history_payment = \DB::table('customer_history_payment')
//            ->where('customer_id', $id->customer_id)
//            ->first();
        $select_stores = SelectStore::all();
        $products = Product::all();
        $colors = Color::all();
        $customer = Customer::where('id', $id->customer_id)->first();
        $user = User::where('id', $id->user_id)->first();


        $users = User::where('id', $user_id)->first();
        $users_s = User::where('id', $user_id_c)->first();
        $invoice_products = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();
        return view('sell.detail.list',
            compact('id', 'customer', 'user', 'invoice_products'
                , 'products', 'colors', 'customer_validation_payment'
                , 'admin_invoice', 'select_stores', 'users', 'users_s'
                , 'invoices_backs', 'user_ids', 'payments', 'factors', 'dataa'
            ));

    }

    public function PrintDetailll(Invoice $id)
    {
        $payments = DB::table('payments')
            ->whereNotNull('invoice_id')
            ->get();
        $user_ids = User::where('id', $id->user_id)->first();
        $invoices_backs = DB::table('factors')
            ->where('customer_id', $id->customer_id)
            ->orderBy('date', 'desc')
            ->get();

        $factors = DB::table('factors')
            ->where('status', 0)
            ->where('end', null)
            ->where('customer_id', $id->customer_id)
            ->orderBy('date', 'desc')
            ->get();

        $dataa = \DB::table('clearing')
            ->where('customer_id', $id->customer_id)
            ->orderBy('date', 'desc')
            ->get();


        $customer_validation_payment = \DB::table('customer_validation_payment')
            ->where('customer_id', $id->customer_id)
            ->first();
        if (!empty($customer_validation_payment->user_id)) {
            $user_id = $customer_validation_payment->user_id;
        } else
            $user_id = null;
        $admin_invoice = \DB::table('admin_invoice')
            ->where('invoice_id', $id->id)
            ->first();
        if (!empty($admin_invoice->user_id)) {
            $user_id_c = $admin_invoice->user_id;
        } else
            $user_id_c = null;

//        $customer_history_payment = \DB::table('customer_history_payment')
//            ->where('customer_id', $id->customer_id)
//            ->first();
        $select_stores = SelectStore::all();
        $products = Product::all();
        $colors = Color::all();
        $customer = Customer::where('id', $id->customer_id)->first();
        $user = User::where('id', $id->user_id)->first();


        $users = User::where('id', $user_id)->first();
        $users_s = User::where('id', $user_id_c)->first();
        $invoice_products = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();
        return view('sell.detail.listt',
            compact('id', 'customer', 'user', 'invoice_products'
                , 'products', 'colors', 'customer_validation_payment'
                , 'admin_invoice', 'select_stores', 'users', 'users_s'
                , 'invoices_backs', 'user_ids', 'payments', 'factors', 'dataa'
            ));

    }

    public function PrintDetaill(Invoice $id)
    {
        $customer_validation_payment = \DB::table('customer_validation_payment')
            ->where('customer_id', $id->customer_id)
            ->first();
        if (!empty($customer_validation_payment->user_id)) {
            $user_id = $customer_validation_payment->user_id;
        } else
            $user_id = null;


        $admin_invoice = \DB::table('admin_invoice')
            ->where('invoice_id', $id->id)
            ->first();
        if (!empty($admin_invoice->user_id)) {
            $user_id_c = $admin_invoice->user_id;
        } else
            $user_id_c = null;

//        $customer_history_payment = \DB::table('customer_history_payment')
//            ->where('customer_id', $id->customer_id)
//            ->first();
        $select_stores = SelectStore::all();
        $products = Product::all();
        $colors = Color::all();
        $customer = Customer::where('id', $id->customer_id)->first();
        $user = User::where('id', $id->user_id)->first();


        $users = User::where('id', $user_id)->first();
        $users_s = User::where('id', $user_id_c)->first();
        $invoice_products = \DB::table('invoice_product')
            ->where('invoice_id', $id->id)
            ->get();
        return view('SellesArchive.print',
            compact('id', 'customer', 'user', 'invoice_products'
                , 'products', 'colors', 'customer_validation_payment'
                , 'admin_invoice', 'select_stores', 'users', 'users_s'));

    }

    public function price(Request $request)
    {

        $product = ProductTitle::where('product_id', $request->id)->get();


        $id = Product::where('id', $request->id)->first();
        return response()->json(['id' => $id, 'product' => $product]);

    }

    public function CheckPrint($id)
    {
        $return = \DB::table('invoice_print_date')
            ->where('invoice_id', $id)->first();
        return response()->json($return);

    }

    public function AdminSuccess(Request $request)
    {
        DB::beginTransaction();
        try {
            Invoice::where('id', $request->id_invoice)->update([
                'state' => 2,
            ]);
            \DB::table('admin_invoice')
                ->updateOrInsert(['invoice_id' => $request->id_invoice],
                    [
                        'user_id' => auth()->user()->id,
                        'invoice_id' => $request->id_invoice,
                        'description' => $request->description,
                    ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function CheckSuccess($id)
    {
        $return = \DB::table('admin_invoice')
            ->where('invoice_id', $id)->first();
        return response()->json($return);
    }

    public function CheckCanceled($id)
    {
        $return = \DB::table('invoice_delete')
            ->where('invoice_id', $id)->first();
        return response()->json($return);
    }

    public function paymentconfrim(Request $request)
    {

        $created_at = Carbon::now();
        if ($request->hasFile('sign')) {
            $file = $request->file('file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $sign = $request->file('file')->move('public/upload/file/', $name);
        } else {
            $sign = null;
        }
        DB::beginTransaction();
        try {
            DB::table('invoice_payment_confrim')->insert([
                'invoice_id' => $request['invoice_id_payment'],
                'file' => $sign,
                'description' => $request['description'],
                'created_at' => $created_at,
            ]);
            Invoice::find($request['invoice_id_payment'])->update([
                'state' => 4,
            ]);
            DB::table('invoice_product')
                ->where('invoice_id', $request->invoice_id_payment)
                ->update([
                    'state' => 1,
                ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }

        return response()->json(['success' => 'success']);

    }

    public function success(Request $request)
    {
        $banks = Bank::where('status', 1)->get();
        $selectstores = SelectStore::where('status', 1)->get();
        $id = auth()->user()->id;
        $role_id = \DB::table('role_user')
            ->where('user_id', $id)->first();
        $role = DB::table('roles')
            ->where('id', $role_id->role_id)
            ->first();
        $invoice_products = DB::table('invoice_product')->get();
        $invoices = Product::all();
        $products = Invoice::all();
        $colors = Color::all();
        if ($role->name == "مدیریت" or $role->name == "Admin" or $role->name == "کارشناس فروش و مالی") {
            if ($request->ajax()) {
                $data = DB::table('invoice_product')
                    ->where('state', 1)
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
                    ->addColumn('invoice', function ($row) {
                        $customer = Invoice::where('id', $row->invoice_id)->first();
                        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->invoice_id . '" data-original-title="ثبت نهایی"
                       class="Print">
                       ' . $customer->invoiceNumber . '
                       </a>';
                        return $btn;
                    })
                    ->addColumn('user', function ($row) {
                        $customer = Invoice::where('id', $row->invoice_id)->first();
                        $name = User::where('id', $customer->user_id)->first();
                        return $name->name;
                    })
                    ->addColumn('customer', function ($row) {
                        $customer = Invoice::where('id', $row->invoice_id)->first();
                        $name = Customer::where('id', $customer->customer_id)->first();
                        return $name->name;
                    })
                    ->addColumn('product', function ($row) {
                        $name = Product::where('id', $row->product_id)->first();
                        return $name->label;
                    })
                    ->addColumn('color', function ($row) {
                        $name = Color::where('id', $row->color_id)->first();
                        return $name->name;
                    })
                    ->addColumn('barn', function ($row) {
                        $name = DB::table('barns_products')
                            ->where('product_id', $row->product_id)
                            ->where('color_id', $row->color_id)
                            ->first();
                        if (!empty($name)) {
                            return $name->Inventory;
                        } else {
                            return '0';
                        }

                    })
                    ->addColumn('barnn', function ($row) {
                        $name = DB::table('barns_products')
                            ->where('product_id', $row->product_id)
                            ->where('color_id', $row->color_id)
                            ->first();
                        if (!empty($name)) {
                            return $name->NumberSold;
                        } else {
                            return '0';
                        }

                    })
                    ->addColumn('action_success', function ($row) {
                        return $this->action_success($row);
                    })
                    ->rawColumns(['action_success', 'checkbox', 'invoice'])
                    ->make(true);
            }
            return view('sell.success',
                compact('invoice_products', 'banks', 'selectstores', 'invoices', 'products', 'colors'));

        }
        if ($role->name == "کارشناس فروش") {
            if ($request->ajax()) {
                $data = DB::table('invoice_product')
                    ->where('user_id', $id)
                    ->where('state', 1)
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
                    ->addColumn('invoice', function ($row) {
                        $customer = Invoice::where('id', $row->invoice_id)->first();
                        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->invoice_id . '" data-original-title="ثبت نهایی"
                       class="Print">
                       ' . $customer->invoiceNumber . '
                       </a>';
                        return $btn;
                    })
                    ->addColumn('user', function ($row) {
                        $customer = Invoice::where('id', $row->invoice_id)->first();
                        $name = User::where('id', $customer->user_id)->first();
                        return $name->name;
                    })
                    ->addColumn('customer', function ($row) {
                        $customer = Invoice::where('id', $row->invoice_id)->first();
                        $name = Customer::where('id', $customer->customer_id)->first();
                        return $name->name;
                    })
                    ->addColumn('product', function ($row) {
                        $name = Product::where('id', $row->product_id)->first();
                        return $name->label;
                    })
                    ->addColumn('color', function ($row) {
                        $name = Color::where('id', $row->color_id)->first();
                        return $name->name;
                    })
                    ->addColumn('barn', function ($row) {
                        $name = DB::table('barns_products')
                            ->where('product_id', $row->product_id)
                            ->where('color_id', $row->color_id)
                            ->first();
                        if (!empty($name)) {
                            return $name->Inventory;
                        } else {
                            return '0';
                        }

                    })
                    ->addColumn('barnn', function ($row) {
                        $name = DB::table('barns_products')
                            ->where('product_id', $row->product_id)
                            ->where('color_id', $row->color_id)
                            ->first();
                        if (!empty($name)) {
                            return $name->NumberSold;
                        } else {
                            return '0';
                        }

                    })
                    ->addColumn('action_success', function ($row) {
                        return $this->action_success($row);
                    })
                    ->rawColumns(['action_success', 'checkbox', 'invoice'])
                    ->make(true);
            }
            return view('sell.success',
                compact('invoice_products', 'banks', 'selectstores', 'invoices', 'products', 'colors'));

        }


    }

    public function detailsuccess(Request $request, Invoice $id)
    {

        if ($request->ajax()) {
            $data = DB::table('invoice_product')
                ->where('status', null)
                ->where('invoice_id', $request->id->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = Product::where('id', $row->product_id)->first();
                    return $product->label;
                })
                ->addColumn('color', function ($row) {
                    $color = Color::where('id', $row->color_id)->first();
                    return $color->name . " - " . $color->manufacturer;
                })
                ->addColumn('barn', function ($row) {
                    $barn = DB::table('barns_products')
                        ->where('product_id', $row->product_id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventory');
                    return $barn;
                })
                ->addColumn('user', function ($row) {
                    $id = Invoice::where('id', $row->invoice_id)->first();
                    $user = User::find($id->user_id)->first();
                    return $user->name;

                })
                ->addColumn('costumer', function ($row) {
                    $id = Invoice::where('id', $row->invoice_id)->first();
                    $user = Customer::find($id->customer_id)->first();
                    return $user->name;

                })
                ->addColumn('detail_success', function ($row) {
                    return $this->detail_success($row);
                })
                ->rawColumns(['detail_success'])
                ->make(true);
        }
        return view('sell.detailsuccess', compact('id'));

    }

    public function storedetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numbere' => 'required',
            'date' => 'required',
        ], [
            'numbere.required' => 'لطفا تعداد ارسالی به تولید را مشخص کنید',
            'date.required' => 'لطفا تاریخ مد نظر برای تحویل را وارد کنید',
        ]);

        $id = DB::table('invoice_product')
            ->where('id', $request->invoice_product)
            ->first();
        $created_at = Carbon::now();
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                DB::table('detail_invoice_list')->insert([
                    'invoice_id' => $id->invoice_id,
                    'invoice_product' => $request->invoice_product,
                    'number' => $request->numbere,
                    'date' => $this->convert2english($request->date),
                    'description' => $request->description,
                    'product_id' => $id->product_id,
                    'created_at' => $created_at,
                ]);
                DB::table('invoice_product')
                    ->where('id', $request->invoice_product)->update([
                        'leftover' => $id->leftover - $request->numbere,
                    ]);
                DB::commit();
                return response()->json(['success' => 'success']);
            } catch (Exception $exception) {
                DB::rollBack();
            }
        }
        return Response::json(['errorr' => $validator->errors()]);


    }

    public function checked($id)
    {
        $number = DB::table('invoice_product')
            ->where('id', $id)
            ->pluck('salesNumber');
        $product = DB::table('detail_invoice_list')
            ->where('invoice_product', $id)
            ->sum('number');


        return response()->json(['number' => $number, 'product' => $product]);
    }

    public function scheduling(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'date' => 'required',
        ], [
            'number.required' => 'لطفا مقدار بارگیری را مشخص کنید',
            'date.required' => 'لطفا تاریخ بارگیری را وارد کنید',
        ]);
        $packs = DB::table('schedulings')->latest('id')->first();
        if (!empty($packs)) {
            $pack = $packs->id;
        } else {
            $pack = 1;
        }
        $number = DB::table('invoice_product')
            ->where('id', $request->scheduling)
            ->first();
        $barn = DB::table('barns_products')
            ->where('product_id', $number->product_id)
            ->where('color_id', $number->color_id)
            ->first();
        $total = $barn->Inventory - $barn->NumberSold;
        if ($request->number > $total) {
            return response()->json(['erro' => 'erro']);
        }
        if ($number->leftover < $request->number) {
            return response()->json(['error' => 'error']);
        } else {
            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    Scheduling::create([
                        'detail_id' => $request->scheduling,
                        'user_id' => $number->user_id,
                        'number' => $request->number,
                        'type' => $request->type,
                        'Carry' => $request->Carry,
                        'date' => $this->convert2english($request->date),
                        'time' => $request->time,
                        'status' => 0,
                        'description' => $request->description,
                        'pack' => $pack,
                    ]);
                    DB::table('invoice_product')
                        ->where('id', $request->scheduling)->update([
                            'leftover' => $number->leftover - $request->number,
                        ]);
                    if ($number->leftover == $request->number) {
                        DB::table('invoice_product')
                            ->where('id', $request->scheduling)->update([
                                'end' => 1,
                            ]);
                    }

                    DB::table('barns_products')
                        ->where('product_id', $number->product_id)
                        ->where('color_id', $number->color_id)
                        ->update([
                            'NumberSold' => $barn->NumberSold + $request->number,
                            'Numbernotsold' => $barn->NumberSold - $barn->Inventory,
                        ]);
                    DB::commit();
                } catch (Exception $exception) {
                    DB::rollBack();
                }
                return response()->json(['success' => 'success']);
            }
            return Response::json(['errorr' => $validator->errors()]);
        }


    }

    public function cancel(Request $request)
    {

        $products = DB::table('invoice_product')
            ->where('id', $request->id_p)
            ->first();
        DB::table('_cancel_product')
            ->insert([
                'product_id' => $request->id_p,
                'total' => $products->salesNumber,
                'left' => $products->leftover,
                'reason' => $request->reason,
                'description' => $request->description,
            ]);
        DB::table('invoice_product')
            ->where('id', $request->id_p)
            ->update([
                'end' => 1,
            ]);
        return response()->json(['success' => 'success']);

    }

    public function massremove(Request $request)
    {

        $id = $request->input('id');

        $deletes = Invoice::withTrashed()->find($id);
        foreach ($deletes as $delete)
            $delete->forceDelete();
        return response()->json(['success' => 'Product saved successfully.']);

    }

    protected $i = [];

    public function ListTime(Request $request)
    {
        $id = $request->input('id');
        return response()->json($id);
    }

    public function actions($row)
    {

        $btn = null;

        if ($row->state == 0) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="سوابق مالی"
                       class="validate">
                       <i class="fa fa-check fa-lg" title="تایید و ارسال به مدیریت"></i>
                       </a>&nbsp;&nbsp;';
        }
        if ($row->state != 0) {
            if (Gate::check('تایید مدیریت')) {
                $btn = $btn . '<a href="' . route('admin.print.detail', $row->id) . '">

                       <i class="fa fa-user fa-lg" title="تایید مدیریت"></i>
                       </a>&nbsp;&nbsp;';
            }

        }

        if (Gate::check('جزییات سوابق مشتری')) {
            $btn = $btn . '<a href="' . route('admin.print.detailllll', $row->id) . '">
                       <i class="fa fa-eye fa-lg" title="جزییات سوابق مشتری"></i>
                       </a>&nbsp;&nbsp;';
        }


        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="چاپ پیش فاکتور"
                       class="Print">

                       <i class="fa fa-print fa-lg" title="چاپ پیش فاکتور"></i>
                       </a>&nbsp;&nbsp;';
        if ($row->state == 2) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="تایید توسط مشتری"
                       class="SuccessCustomer">

                       <i class="fa fa-check fa-lg" title="تایید توسط مشتری"></i>
                       </a>&nbsp;&nbsp;';
        }


//        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
//                      data-id="' . $row->id . '" data-original-title="سابقه پرداخت مشتری"
//                       class="many">
//                       <img src="' . $many . '" width="20" title="سابقه پرداخت مشتری"></a>';


//        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
//                      data-id="' . $row->id . '" data-original-title="تایید پرداخت"
//                       class="Confirmpayment">
//                       <i class="fa fa-dollar fa-lg" title="تایید پرداخت"></i>
//                       </a>&nbsp;&nbsp;';


        $btn = $btn . '<a href="' . route('admin.invoice.update', $row->id) . '">
                       <i class="fa fa-edit fa-lg" title="ویرایش پیش فاکتور"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">

                       <i class="fa fa-times fa-lg" title="لغو پیش فاکتور"></i>
                       </a>&nbsp;&nbsp;';


//        $btn = $btn . '<a href="' . route('admin.invoice.print', $row->id) . '" target="_blank">
//                       <img src="' . $print . '" width="20" title="چاپ پیش فاکتور"></a>';

        return $btn;

    }

    public function action($row)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ثبت نهایی"
                       class="question">
                       <i class="fa fa-question fa-lg" title="ثبت نهایی"></i>
                       </a>';
        return $btn;

    }

    public function action_success($row)
    {

        $barn = DB::table('barns_products')
            ->where('product_id', $row->product_id)
            ->where('color_id', $row->color_id)
            ->sum('Inventory');

        $btn = null;


        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="بارگیری"
                       class="scheduling">
                       <i class="fa fa-spinner fa-spin fa-lg fa-fw" title="بارگیری"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ارسال به صف"
                       class="SendToListNumber">
                       <i class="fa fa-list fa-lg" title="ارسال به صف"></i>
                       </a>&nbsp;&nbsp;';

        if (Gate::check('ویرایش پیش فاکتور تایید شده')) {
            $btn = $btn . '<a href="' . route('admin.invoice.product.update', $row->invoice_id) . '">
                       <i class="fa fa-edit fa-lg" title="ویرایش پیش فاکتور"></i>
                       </a>&nbsp;&nbsp;';
        }
        if (Gate::check('انصراف از فروش')) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="انصراف از فروش"
                       class="cancel">
                       <i class="fa fa-remove fa-lg" title="انصراف از فروش"></i>
                       </a>&nbsp;&nbsp;';
        }

        return $btn;

    }

    public function detail_success($row)
    {
        $barn = DB::table('barns_products')
            ->where('product_id', $row->product_id)
            ->where('color_id', $row->color_id)
            ->sum('Inventory');
        $btn = null;
        if (empty($row->end)) {
            if ($barn >= $row->salesNumber) {
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="بارگیری"
                       class="scheduling">
                       <i class="fa fa-spinner fa-spin fa-lg fa-fw" title="بارگیری"></i>
                       </a>&nbsp;&nbsp;';
            }
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ارسال به صف"
                       class="SendToListNumber">
                       <i class="fa fa-list fa-lg" title="ارسال به صف"></i>
                       </a>&nbsp;&nbsp;';
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
