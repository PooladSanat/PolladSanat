<?php

namespace App\Http\Controllers\Sell;

use App\Color;
use App\Complaints;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Product;
use App\User;
use Carbon\Carbon;
use DB;
use Grpc\Call;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class ComplaintsController extends Controller
{
    public function list(Request $request)
    {
        $products = Product::all();
        $customers = Customer::all();
        $colors = Color::all();
        $invoices = Invoice::all();
        if ($request->ajax()) {
            $data = Complaints::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('code', function ($row) {
                    $btn = '<a href="' . route('admin.Complaints.list.detail', $row->id) . '">
                     ' . $row->code . '
                      </a>';
                    return $btn;
                })
                ->addColumn('invoice', function ($row) {
                    $name = array();
                    $invoice_numbers = DB::table('detail_returns')
                        ->where('complaints_id', $row->id)->get();
                    foreach ($invoice_numbers as $invoice_number) {
                        $invoices = Invoice::where('id', $invoice_number->invoice_id)->get();
                        foreach ($invoices as $invoice) {
                            $name[] = $invoice->invoiceNumber;
                        }
                    }
                    return $name;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'در حال برسی';
                    } elseif ($row->status == 2) {
                        return 'اتمام یافته';
                    } else {
                        return 'مرجوع شده';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'code'])
                ->make(true);
        }
        return view('Complaints.list', compact('invoices', 'products', 'customers', 'colors'));
    }

    public function item(Request $request)
    {
        $state = DB::table('invoices')
            ->where('customer_id', $request->commodity_id)->get();
        return response()->json($state);
    }

    public function invoice(Request $request)
    {
        $state = DB::table('invoices')
            ->whereIn('id', $request->commodity_id)
            ->distinct('id')
            ->get();
        return response()->json($state);
    }

    public function store(Request $request)
    {
        $code = Complaints::count();
        $Complaints = Complaints::create([
            'code' => 100 + $code,
            'user_id' => auth()->user()->id,
            'date' => $request->datee,
            'customer_id' => $request->customerre,
            'title' => $request->title,
            'importance' => $request->importance,
            'Notices' => $request->Notices,
            'description' => $request->descriptionk,
            'descriptionm' => $request->descriptionm,
            'status' => 1,
        ]);
        if (!empty($request->file('fille'))) {
            $img = [];
            foreach ($request->file('fille') as $image) {
                $destinationPath = 'public/upload/fille/';
                $name = time() . '.' . $image->getClientOriginalName();
                $file_com = $image->move($destinationPath, $name);
                $img[] = $file_com;

            }
        } else {
            $img = ['null'];
        }


        try {
            $filee = count(collect($request)->get('product'));
            for ($i = 0; $i <= $filee; $i++) {
                DB::table('detail_returns')->insert([
                    'complaints_id' => $Complaints->id,
                    'invoice_id' => $request->get('invoice')[$i],
                    'product_id' => $request->get('product')[$i],
                    'color_id' => $request->get('color')[$i],
                    'number' => $request->get('number')[$i],
                    'reason' => $request->get('reasons')[$i],
                    'file' => $img[$i],
                ]);
            }
        } catch (\Exception $e) {
        }

        return response()->json(['success' => 'success']);
    }

    public function detail(Complaints $id)
    {
        $complaint_actions = DB::table('complaint_action')
            ->where('id_complaint', $id->id)
            ->orderBy('id', 'DESC')
            ->get();

        $file_complaint_action = DB::table('file_complaint_action')
            ->get();

        $copy_complaint_actions = DB::table('copy_complaint_action')
            ->get();

        $audience_complaint_actions = DB::table('audience_complaint_action')
            ->get();
        $users = User::all();

        $number = DB::table('detail_returns')
            ->where('complaints_id', $id->id)
            ->sum('number');

        $details = DB::table('detail_returns')
            ->where('complaints_id', $id->id)
            ->get();

        $customers = Customer::all();
        $products = Product::all();
        $invoices = Invoice::all();
        return view('Complaints.listdetail',
            compact('users', 'invoices', 'id', 'products',
                'customers', 'number', 'details', 'complaint_actions',
                'audience_complaint_actions', 'copy_complaint_actions',
                'file_complaint_action'));
    }

    public function check(Request $request)
    {

        $data = DB::table('complaints')
            ->where('id', $request->id)
            ->first();
        $detail_returns = DB::table('detail_returns')
            ->whereNull('state')
            ->where('complaints_id', $request->id)
            ->get();

        if (empty($data)) {
            $data = DB::table('returns')
                ->where('id', $request->id)
                ->first();
            $detail_returns = DB::table('detail_returns')
                ->whereNull('state')
                ->where('return_id', $request->id)
                ->get();
            return response()->json(['data' => $data, 'detail_returns' => $detail_returns]);

        }
        return response()->json(['data' => $data, 'detail_returns' => $detail_returns]);

    }

    public function file(Request $request)
    {
        $data = DB::table('file_complaint_action')
            ->where('id_complaint_action', $request->id)
            ->get();
        return response()->json($data);

    }

    public function StoreDetail(Request $request)

    {

        $date = Carbon::now();

        DB::table('complaint_action')
            ->insert([
                'user_id' => auth()->user()->id,
                'id_complaint' => $request->id_com,
                'operation' => $request->operation,
                'uruency' => $request->Urgency,
                'description' => $request->descriptiond,
                'created_at' => $date,
            ]);
        $complaint_action = DB::table('complaint_action')
            ->latest('id')->first();
        if (!empty($request->get('ttitle'))) {
            $img = [];
            foreach ($request->file('ffile') as $image) {
                $destinationPath = 'public/upload/file_complaint_action/';
                $name = time() . '.' . $image->getClientOriginalName();
                $file_com = $image->move($destinationPath, $name);
                $img[] = $file_com;

            }
        }
        try {
            $title = count(collect($request)->get('Audience'));
            for ($i = 0; $i < $title; $i++) {
                DB::table('audience_complaint_action')->insert([
                    'id_complaint_action' => $complaint_action->id,
                    'id_actioner' => $request->get('Audience')[$i],
                ]);
            }
        } catch (Exception $exception) {
        }
        try {
            $title = count(collect($request)->get('Copy'));
            for ($i = 0; $i < $title; $i++) {
                DB::table('copy_complaint_action')->insert([
                    'id_complaint_action' => $complaint_action->id,
                    'id_copy' => $request->get('Copy')[$i],
                ]);
            }
        } catch (Exception $exception) {
        }
        if (!empty($request->get('ttitle'))) {
            try {
                $title = count(collect($request)->get('ttitle'));
                for ($i = 0; $i < $title; $i++) {
                    DB::table('file_complaint_action')->insert([
                        'id_complaint_action' => $complaint_action->id,
                        'title' => $request->get('ttitle')[$i],
                        'file' => $img[$i],
                    ]);
                }
            } catch (Exception $exception) {
                return response()->json(['success' => 'success']);

            }
        }
        return response()->json(['success' => 'success']);
    }

    public function close(Request $request)
    {

//        $date = Carbon::now();
//
//        DB::table('complaint_action')
//            ->insert([
//                'user_id' => auth()->user()->id,
//                'id_complaint' => $request->id,
//                'operation' => 'اتمام درخواست',
//                'created_at' => $date,
//            ]);


        $Complaints = Complaints::where('id', $request->id)->update([
            'status' => 2,
        ]);
        return response()->json($Complaints);

    }

    public function filedes(Request $request)
    {
        $data = DB::table('complaint_action')->where('id', $request->id)
            ->first();
        return response()->json($data);
    }

    public function actions($row)
    {
        $btn = null;
        if ($row->status == 2) {

            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="درخواست مرجوعی"
                       class="returns">
                       <i class="fa fa-mail-reply-all fa-lg" title="درخواست مرجوعی"></i>
                       </a>&nbsp;&nbsp;';
        }
        return $btn;
    }
}
