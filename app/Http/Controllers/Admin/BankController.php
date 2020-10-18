<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BankController extends Controller
{
    /**
     * نمایش لیست بانکهای موجود  در دیتابیس
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Bank::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'فعال';
                    } else
                        return 'غیر فعال';
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('bank.list');

    }

    /**
     * ذخیره اطلاعات بانک جدید در دیتابیس
     */
    public function store(Request $request)
    {
        Bank::updateOrCreate(['id' => $request->id],
            [
                'name' => $request->name,
                'NameBank' => $request->NameBank,
                'CardNumber' => $request->CardNumber,
                'AccountNumber' => $request->AccountNumber,
                'ShabaNumber' => $request->ShabaNumber,
                'status' => $request->status,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);
    }

    /**
     * ویرایش اطلاعات بانک در دیتابیس
     */
    public function update($id)
    {
        $bank = Bank::find($id);
        return response()->json($bank);
    }

    /**
     * حذف مشخصات بانک در دیتابیس
     */
    public function delete($id)
    {
        $delete = Bank::find($id);
        $delete->delete();
        return response()->json(['success' => 'Product saved successfully.']);
    }

    /**
     * دکمههای موجود در لیست بانکها
     */
    public function actions($row)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                      <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                      </a>&nbsp;&nbsp;';
        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        return $btn;

    }
}
