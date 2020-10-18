<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Models;
use App\User;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class ModelController extends Controller
{
    /**
     * نمایش لیست قالب سازها *
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Models::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('models.list');
    }

    /**
     * ثبت مشخصات قالب سازها *
     */
    public function store(Request $request)
    {
        if (!empty($request->product_id)) {
            $models = Models::find($request->product_id);
            if ($models->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ], [
                    'name.required' => 'لطفا نام سازنده قالب را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ], [
                    'name.required' => 'لطفا نام سازنده قالب را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ], [
                'name.required' => 'لطفا نام سازنده قالب را وارد کنید',
            ]);
        if ($validator->passes()) {
            Models::updateOrCreate(['id' => $request->product_id],
                ['name' => $request->name, 'code' => $request->code]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * حذف مشخصات قالب سازها *
     */
    public function delete($id)
    {
        $post = Models::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     *ویرایش مشخصات قالب سازها *
     */
    public function update($id)
    {
        $product = Models::find($id);
        return response()->json($product);
    }

    /**
     * اکشن های دیتا تیبل *
     */
    public function actions($row)
    {

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
