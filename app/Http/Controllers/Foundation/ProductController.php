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

class ProductController extends Controller
{
    /**
     * نمایش لیست محصولات *
     */
    public function list(Request $request)
    {
        $ProductCharacteristics = ProductCharacteristic::all();
        $commoditys = Commodity::all();
        if ($request->ajax()) {
            $data = Product::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->addColumn('commodity_id', function ($row) {
                    return $row->commodity->name;
                })
                ->addColumn('price', function ($row) {
                    $price = number_format($row->price);
                    return $price;
                })
                ->addColumn('manufacturing', function ($row) {
                    if ($row->manufacturing == 1) {
                        return 'داخلی';
                    } elseif ($row->manufacturing == 2) {
                        return 'خارجی';
                    } else
                        return '';
                })
                ->addColumn('characteristics_id', function ($row) {
                    $characteristics_id = ProductCharacteristic::find($row->characteristics_id);
                    if (!empty($characteristics_id)) {
                        return $characteristics_id->name;

                    } else {
                        return 'بدون مشخصه';

                    }
                })
                ->rawColumns(['action', 'commodity_id', 'characteristics_id'])
                ->make(true);
        }
        return view('product.list', compact('commoditys', 'ProductCharacteristics'));
    }

    /**
     * تعامل بین گروه کالایی و مشخصه محصول ایجکس *
     */
    public function getcharacteristic(Request $request)
    {
        $states = \DB::table("product_characteristics")
            ->where("commodity_id", $request->commodity_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function getcharacteristicu(Request $request)
    {
        $states = \DB::table("product_characteristics")
            ->where("commodity_id", $request->commodity_id)
            ->get();
        return response()->json(['states' => $states]);
    }

    /**
     * ثبت مشخصات محصولات *
     */
    public function store(Request $request)
    {
        $string = preg_split("/,/", "$request->price");
        $count = count($string);
        $number = null;
        for ($i = 0; $i < $count; $i++) {
            $number .= $string[$i];
        }
        if (!empty($request->product_id)) {
            $products = Product::find($request->product_id);
            if ($products->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'price' => 'required',
                ], [
                    'name.required' => 'پرکردن نام محصول الزامی میباشد',
                    'price.required' => 'لطفا قیمت محصول را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'price' => 'required',
                ], [
                    'name.required' => 'پرکردن نام محصول الزامی میباشد',
                    'price.required' => 'لطفا قیمت محصول را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
            ], [
                'name.required' => 'پرکردن نام محصول الزامی میباشد',
                'price.required' => 'لطفا قیمت محصول را وارد کنید',
            ]);

        $commodity = Commodity::where('id', $request->commodity_id)->first();
        $characteristic = ProductCharacteristic::where('id', $request->characteristic)->first();
        if ($characteristic) {
            $name = $characteristic->name;
        } else {
            $name = null;
        }

        if ($validator->passes()) {
            Product::updateOrCreate(['id' => $request->product_id],
                [
                    'name' => $request->name,
                    'code' => $request->code,
                    'commodity_id' => $request->commodity_id,
                    'characteristics_id' => $request->characteristic,
                    'manufacturing' => $request->manufacturing,
                    'price' => $number,
                    'minimum' => $request->minimum,
                    'maximum' => $request->maximum,
                    'label' => $commodity->name . ' ' . $name . ' ' . $request->name,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);


    }

    /**
     * حذف مشخصات محصولات *
     */
    public function delete($id)
    {
        $post = Product::findOrFail($id);
        $post->delete();
        return response()->json($post);

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
     * ویرایش مشخصات محصولات *
     */
    public function update($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
}
