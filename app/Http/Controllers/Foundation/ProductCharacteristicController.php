<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Commodity;
use App\Product;
use App\ProductCharacteristic;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;
use function App\Providers\MsgSuccess;

class ProductCharacteristicController extends Controller
{
    /**
     * نمایش لیست مشخصه محصولات *
     */
    public function list(Request $request)
    {
        $commoditys = Commodity::all();
        if ($request->ajax()) {
            $data = ProductCharacteristic::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->addColumn('commodity_id', function ($row) {
                    return $row->commodity->name;
                })
                ->rawColumns(['action', 'commodity_id'])
                ->make(true);
        }
        return view('ProductCharacteristic.list', compact('commoditys'));
    }

    /**
     * ثبت مشخصات مشخصه محصول *
     */
    public function store(Request $request)
    {
        if (!empty($request->product_id)) {
            $characteristics = ProductCharacteristic::find($request->product_id);
            if ($characteristics->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'commodity_id' => 'required',
                    'name' => 'required',
                ], [
                    'commodity_id.required' => 'گروه کالایی را انتخاب کنید',
                    'name.required' => 'لطفا نام مشخصه محصول  را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'commodity_id' => 'required',
                    'name' => 'required',
                ], [
                    'commodity_id.required' => 'گروه کالایی را انتخاب کنید',
                    'name.required' => 'لطفا نام مشخصه محصول  را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'commodity_id' => 'required',
                'name' => 'required',

            ], [
                'commodity_id.required' => 'گروه کالایی را انتخاب کنید',
                'name.required' => 'لطفا نام مشخصه محصول  را وارد کنید',
            ]);
        if ($validator->passes()) {
            ProductCharacteristic::updateOrCreate(['id' => $request->product_id],
                [
                    'name' => $request->name,
                    'code' => $request->code,
                    'commodity_id' => $request->commodity_id,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
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

    /**
     * حذف مشخصات مشخصه محصول *
     */
    public function delete($id)
    {
        $post = ProductCharacteristic::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش مشخصات مشخصه محصول *
     */
    public function update($id)
    {
        $product = ProductCharacteristic::find($id);
        return response()->json($product);
    }

}
