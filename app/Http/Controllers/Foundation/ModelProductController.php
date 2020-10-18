<?php

namespace App\Http\Controllers\Foundation;

use App\Format;
use App\Http\Controllers\Controller;
use App\Insert;
use App\ModelProduct;
use App\Product;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class ModelProductController extends Controller
{
    /**
     * نمایش لیست
     */
    public function list(Request $request)
    {
        $products = Product::all();
        $formats = Format::all();
        $inserts = Insert::all();
        if ($request->ajax()) {
            $data = ModelProduct::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('format', function ($row) {
                    return $row->format->name;
                })
                ->addColumn('insert', function ($row) {
                    $id = Insert::where('id', $row->insert_id)->first();
                    if (!empty($id)) {
                        return $id->name;
                    } else {
                        return 'فاقد اینسرت';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('model_product.list',
            compact('products', 'formats', 'inserts'));

    }

    /**
     * ثبت اطلاعات
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'size' => 'required|integer',
        ], [
            'size.required' => 'لطفا وزن را وارد کنید',
            'size.integer' => 'وزن باید از نوع عدد باشد',
        ]);

        if ($validator->passes()) {
            ModelProduct::updateOrCreate(['id' => $request->product],
                [
                    'product_id' => $request->product_id,
                    'format_id' => $request->format_id,
                    'insert_id' => $request->insert_id,
                    'size' => $request->size,
                    'cycletime' => $request->cycletime,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * ویرایش اطلاعات
     */
    public function update($id)
    {
        $product = ModelProduct::find($id);
        return response()->json($product);
    }

    /**
     * حذف اطلاعات
     */
    public function delete($id)
    {
        $post = ModelProduct::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * دکمه های موجود در دیتاتیبل
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
