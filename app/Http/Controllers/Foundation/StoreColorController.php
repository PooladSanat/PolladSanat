<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\StoreColor;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class StoreColorController extends Controller
{

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = StoreColor::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('storecolor.list');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
        ], [
            'name.required' => 'نام دستگاه را وارد کنید',
        ]);
        if ($validator->passes()) {
            StoreColor::updateOrCreate(['id' => $request->product_id],
                [
                    'name' => $request->name,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function delete($id)
    {
        $post = StoreColor::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    public function update($id)
    {
        $product = StoreColor::find($id);
        return response()->json($product);
    }

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
