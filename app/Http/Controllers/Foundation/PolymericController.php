<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Polymeric;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class PolymericController extends Controller
{
    /**
     * نمایش لیست مواد پلیمیری *
     */
    public function list(Request $request)
    {
        $products = Product::all();
        $sellers = Seller::all();
        if ($request->ajax()) {
            $data = Polymeric::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->addColumn('name', function ($row) {
                    $id = Seller::where('id', $row->name)->first();
                    if (!empty($id)) {
                        return $id->company;
                    } else {
                        return '--------';
                    }

                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('polymeric.list', compact('products', 'sellers'));

    }

    /**
     * ثبت مشخصات مواد پلیمیری *
     */
    public function store(Request $request)
    {
        $string = preg_split("/,/", "$request->price");
        $count = count($string);
        $number = null;
        for ($i = 0; $i < $count; $i++) {
            $number .= $string[$i];
        }
        if (!empty($request->product)) {
            $polymerics = Polymeric::find($request->product);
            if ($polymerics->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'type' => 'required',
                    'grid' => 'required',
                    'name' => 'required',
                ], [
                    'name.required' => 'نام مواد پلیمیری را وارد کنید',
                    'type.required' => 'نوع مواد پلیمیری را وارد کنید',
                    'grid.required' => 'نام گرید مواد پلیمیری را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'type' => 'required',
                    'grid' => 'required',
                    'name' => 'required',
                ], [
                    'name.required' => 'نام مواد پلیمیری را وارد کنید',
                    'type.required' => 'نوع مواد پلیمیری را وارد کنید',
                    'grid.required' => 'نام گرید مواد پلیمیری را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'grid' => 'required',
                'name' => 'required',

            ], [
                'name.required' => 'نام مواد پلیمیری را وارد کنید',
                'type.required' => 'نوع مواد پلیمیری را وارد کنید',
                'grid.required' => 'نام گرید مواد پلیمیری را وارد کنید',
            ]);
        if ($validator->passes()) {
            Polymeric::updateOrCreate(['id' => $request->product],
                [
                    'name' => $request->name,
                    'code' => $request->code,
                    'type' => $request->type,
                    'grid' => $request->grid,
                    'description' => $request->description,
                    'price' => $number,
                    'minimum' => $request->minimum,
                    'maximum' => $request->maximum,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * حذف مشخصات مواد پلیمیری *
     */
    public function delete($id)
    {
        $post = Polymeric::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش مشخصات گروه کالایی *
     */
    public function update($id)
    {
        $product = Polymeric::find($id);
        return response()->json($product);
    }

    /**
     * اکشن های دیتا تیبل *
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
