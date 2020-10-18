<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Insert;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class InserController extends Controller
{
    /**
     * نمایش لیست insert ها
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Insert::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('insert.list');

    }

    /**
     * ثبت اطلاعات
     */
    public function store(Request $request)
    {
        if (!empty($request->product)) {
            $inserts = Insert::find($request->product)->first();
            if ($request->code != $inserts->code) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'manufacturer' => 'required',
                ], [
                    'name.required' => 'لطفا نام insert را وارد کنید',
                    'manufacturer.required' => 'لطفا نام سازنده را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'manufacturer' => 'required',
                ], [
                    'name.required' => 'لطفا نام insert را وارد کنید',
                    'manufacturer.required' => 'لطفا نام سازنده را وارد کنید',
                ]);
        } else

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'manufacturer' => 'required',
            ], [
                'name.required' => 'لطفا نام insert را وارد کنید',
                'manufacturer.required' => 'لطفا نام سازنده را وارد کنید',
            ]);

        if ($validator->passes()) {
            Insert::updateOrCreate(['id' => $request->product],
                [
                    'code' => $request->code,
                    'manufacturer' => $request->manufacturer,
                    'name' => $request->name,
                    'time' => $request->time,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * ویراش اطلاعات
     */
    public function update($id)
    {
        $product = Insert::find($id);
        return response()->json($product);
    }

    /**
     * حذف اطلاعات
     */
    public function delete($id)
    {
        $post = Insert::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * دکمه های عملیات موجود در دیتا تیبل insert
     */
    public function actions($row)
    {
        $success = url('/public/icon/icons8-edit-144.png');
        $delete = url('/public/icon/icons8-delete-bin-96.png');

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
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
