<?php

namespace App\Http\Controllers\Payment;

use App\Customer;
use App\Http\Controllers\Controller;
use App\RequestMoney;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class RequestMoneyController extends Controller
{

    public function list(Request $request)
    {
        $customers = Customer::all();
        if ($request->ajax()) {
            $data = RequestMoney::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {

                    $name = Customer::where('id', $row->customer_id)->first();
                    return $name->name;
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'بسیار مهم';
                    } elseif ($row->status == 2) {
                        return 'مهم';
                    } else {
                        return 'عادی';
                    }
                })
                ->addColumn('state', function ($row) {
                    if ($row->state == null) {
                        return 'در انتظار بررسی مدیریت';
                    } elseif ($row->state == 1) {
                        return 'تایید توسط مدیریت';
                    } elseif ($row->state == 2) {
                        return 'عدم تایید توسط مدیریت';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('RequestMoney.list', compact('customers'));

    }

    public function store(Request $request)
    {
        $created_at = Carbon::now();
        RequestMoney::updateOrCreate(['id' => $request->id],
            [
                'customer_id' => $request->customer_i,
                'price' => $request->price,
                'status' => $request->status,
                'description' => $request->description,
                'created_at' => $created_at,
                'date' => Jalalian::forge($created_at)->format('Y/m/d'),
            ]);
        return response()->json(['success' => 'success']);
    }

    public function storestatus(Request $request)
    {
        $created_at = Carbon::now();
        \DB::table('request_money_admin')
            ->insert([
                'requestmoney_id' => $request->edit_id,
                'status' => $request->status,
                'description' => $request->description,
                'created_at' => $created_at,
            ]);
        \DB::table('request_money')
            ->where('id', $request->edit_id)
            ->update([
                'state' => $request->status,
            ]);

        return response()->json(['success' => 'success']);

    }

    public function delete($id)
    {
        $delete = RequestMoney::find($id);
        $delete->delete();
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function filter(Request $request)
    {
        $price = \DB::table('View_Transaction')
            ->where('customer_id', $request->id)
            ->sum('price');

        $sum = \DB::table('View_Transaction')
            ->where('customer_id', $request->id)
            ->sum('sum');
        if (!empty($price)) {
            $data = $price - $sum;
        } else {
            $data = 0;
        }


        return response()->json($data);

    }

    public function update($id)
    {
        $bank = RequestMoney::find($id);
        return response()->json($bank);
    }

    public function admin($id)
    {
        $request_money = \DB::table('request_money')
            ->where('id', $id)
            ->first();
        $requestmoneys = \DB::table('View_Transaction')
            ->where('customer_id', $request_money->customer_id)
            ->orderBy('date', 'desc')
            ->get();

        return view('RequestMoney.admin', compact('id', 'requestmoneys', 'request_money'));
    }

    public function CustomerTransactions(Request $request)
    {


        if ($request->ajax()) {

            $data = \DB::table('View_Transaction')
                ->where('date', '!=', "1399")
                ->where('customer_id', $request->from_check)
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
                    if (!empty($row->price)) {
                        return $row->descriptionn;
                    } else {
                        return 'بدهی بابت فاکتور' . ' ' . $row->rahkaran;
                    }
                })
                ->rawColumns([])
                ->make(true);

        }
        return view('CustomerTransactions.list');
    }

    public function actions($row)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                      <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                      </a>&nbsp;&nbsp;';


        $btn = $btn . '<a href="' . route('admin.RequestMoney.admin', $row->id) . '">
                       <i class="fa fa-user fa-lg" title="تایید مدیریت"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        return $btn;

    }

}
