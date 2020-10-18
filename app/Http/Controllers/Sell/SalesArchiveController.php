<?php

namespace App\Http\Controllers\Sell;

use App\Bank;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\SelectStore;
use App\User;
use DB;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class SalesArchiveController extends Controller
{
    public function list(Request $request)
    {
        $id = auth()->user()->id;
        $role_id = \DB::table('role_user')
            ->where('user_id', $id)->first();
        $role = DB::table('roles')
            ->where('id', $role_id->role_id)
            ->first();
        $banks = Bank::where('status', 1)->get();
        $selectstores = SelectStore::where('status', 1)->get();
        if ($role->name == "مدیریت" or $role->name == "Admin" or $role->name == "کارشناس فروش و مالی" or $role->name == "مسئول حمل و نقل" or $role->name == "مدیر انبار") {
            $user_id = [12, 13, 14, 15, 16, 17, 18, 19, 22, 24, 25];
        }
        if ($role->name == "کارشناس فروش") {
            $user_id = [auth()->user()->id];
        }

        if ($request->ajax()) {
            $data = DB::table('View_SalesArchive')
                ->whereIn('user_id', $user_id)
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('price_sell', function ($row) {
                    return number_format($row->price_sell);
                })

                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('SellesArchive.list', compact('banks', 'selectstores'));

    }

    public function actions($row)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="چاپ فاکتور"
                       class="Print">
                        <i class="fa fa-print fa-lg" title="چاپ فاکتور"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="' . route('admin.print.detaill', $row->id) . '" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="جزییات فاکتور"
                       class="deletep">
                        <i class="fa fa-info-circle fa-lg" title="جزییات فاکتور"></i>
                       </a>';
        return $btn;
    }
}
