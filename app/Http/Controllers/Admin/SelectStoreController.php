<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SelectStore;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SelectStoreController extends Controller
{
    /**
     * لیست انبارهای موجود در دیتابیس
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = SelectStore::get();
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
        return view('selectStore.list');
    }

    /**
     * ذخیره اطلاعات انبارها در دیتابیس
     */
    public function store(Request $request)
    {
        SelectStore::updateOrCreate(['id' => $request->id],
            [
                'name' => $request->name,
                'tel' => $request->tel,
                'address' => $request->address,
                'status' => $request->status,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);
    }

    /**
     * ویرایش اطلاعات انبار در دیتابیس
     */
    public function update($id)
    {
        $bank = SelectStore::find($id);
        return response()->json($bank);
    }

    /**
     * حذف اطلاعات انبار از دیتابیس
     */
    public function delete($id)
    {
        $delete = SelectStore::find($id);
        $delete->delete();
        return response()->json(['success' => 'Product saved successfully.']);
    }

    /**
     * دکمههای موجود در لیست انبارها
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
