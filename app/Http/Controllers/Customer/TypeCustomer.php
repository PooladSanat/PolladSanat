<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class TypeCustomer extends Controller
{
    /**
     * نمایش لیست انواع مشتریان
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = \App\TypeCustomer::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    if ($row->type == 1) {
                        return 'شرکتی';
                    } else
                        return 'شخصی';
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('typeCustomer.list');
    }

    /**
     * ثبت اطلاعات انواع مشتریان
     */
    public function store(Request $request)
    {
        if (!empty($request->product)) {
            $color = \App\TypeCustomer::find($request->product);
            if ($color->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ], [
                    'name.required' => 'نام مشتری را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ], [
                    'name.required' => 'نام مشتری را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ], [
                'name.required' => 'نام مشتری را وارد کنید',
            ]);

        if ($validator->passes()) {
            \App\TypeCustomer::updateOrCreate(['id' => $request->product],
                [
                    'code' => $request->code,
                    'name' => $request->name,
                    'type' => $request->type,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * ویرایش اطلاعات انواع مشتریان
     */
    public function update($id)
    {
        $product = \App\TypeCustomer::find($id);
        return response()->json($product);
    }

    /**
     * حذف انواع مشتریان
     */
    public function delete($id)
    {
        $post = \App\TypeCustomer::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * دکمه عملیات موجود در دیتا تیبل انواع مشتریان
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
