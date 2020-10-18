<?php

namespace App\Http\Controllers\Foundation;

use App\Bom;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class BomController extends Controller
{
    /**
     * نمایش لیست bom
     */
    public function list(Request $request)
    {
        $products = Product::all();
        if ($request->ajax()) {
            $data = Bom::distinct()->select('product_id')->groupBy('product_id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $products = Product::where('id', $row->product_id)->first();
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->product_id . '"
                       class="details">
                      ' . $products->label . '
                      </a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'product'])
                ->make(true);
        }
        return view('bom.list', compact('products'));

    }

    /**
     * ثبت اطلاعات
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'number' => 'required|integer',
        ], [
            'number.required' => 'لطفا تعداد را وارد کنید',
            'number.integer' => 'تعداد باید از نوع عدد باشد',
        ]);
        $products = Bom::where('product_id', $request->product_id)->get();
        foreach ($products as $product)
            if (empty($request->pr)) {
                if ($product->bom_id == $request->bom_id) {
                    return response()->json(['unm' => 'این زیر مجمعه برای محصول انتخاب شده است']);
                }
            }
        if ($validator->passes()) {
            Bom::updateOrCreate(['id' => $request->pr],
                [
                    'product_id' => $request->product_id,
                    'bom_id' => $request->bom_id,
                    'number' => $request->number,
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
        $product = Bom::find($id);
        return response()->json($product);
    }

    /**
     * نمایش اطلاعات بر اساس sort
     */
    public function detail(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Bom::where('product_id', $id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('bom', function ($row) {
                    $boms = Product::where('id', $row->bom_id)->first();
                    return $boms->label;
                })
                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns(['action', 'product'])
                ->make(true);
        }
        return response()->json($data);
    }

    /**
     * حذف مشخصات bom
     */
    public function delete($id)
    {
        $post = Bom::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * حذف فایل زیر مجوعه
     */
    public function deletep($id)
    {

        $boms = Bom::where('product_id', $id)->get();
        foreach ($boms as $bom)
            $post = Bom::find($bom->id)->delete();
        return response()->json($post);
    }

    /**
     * دکمه های عملیاتن موجود در دیتا تیبل
     */
    public function actions($row)
    {


        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->product_id . '" data-original-title="حذف"
                       class="deletep">
                        <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        return $btn;

    }

    /**
     * دکمه های عملیاتن موجود در دیتا تیبل
     */
    public function action($row)
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

    /**
     * فیلتر کردن اطلاعات برای نمایش در بخش زیر مجموعه ها
     */
    public function filter(Request $request)
    {
        $bom_id = \DB::table("products")
            ->where("id", '!=', $request->product)
            ->pluck("label", "id");
        return response()->json($bom_id);
    }

    /**
     * ذخیره اطلاعات bom
     */
    public function bom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|integer',
        ], [
            'number.required' => 'لطفا تعداد را وارد کنید',
            'number.integer' => 'تعداد باید از نوع عدد باشد',
        ]);

        $products = Bom::where('product_id', $request->id_product)->get();
        foreach ($products as $product)

            if ($product->bom_id == $request->bom_id) {
                return response()->json(['unm' => 'این زیر مجمعه برای محصول انتخاب شده است']);
            }


        if ($validator->passes()) {
            Bom::Create(
                [
                    'product_id' => $request->id_product,
                    'bom_id' => $request->bom_id,
                    'number' => $request->number,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

}
