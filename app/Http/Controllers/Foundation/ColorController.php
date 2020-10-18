<?php

namespace App\Http\Controllers\Foundation;

use App\Color;
use App\Http\Controllers\Controller;
use App\Masterbatch;
use App\StoreColor;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;
use function App\Providers\MsgSuccess;

class ColorController extends Controller
{
    /**
     * نمایش لیست رنگها *
     */
    public function listttt(Request $request)
    {



        $colors = StoreColor::all();
        $masters = Masterbatch::all();
        if ($request->ajax()) {
            $data = Color::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->addColumn('color', function ($row) {
                    $color = StoreColor::where('id', $row->color)->first();
                    return $color->name;
                })
                ->addColumn('price', function ($row) {
                    return number_format($row->price);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('colors.list', compact('colors','masters'));
    }

    /**
     * ثبت مشخصات رنگها *
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
            $color = Color::find($request->product_id);
            if ($color->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'combination' => 'required',
                ], [
                    'combination.required' => 'درصد ترکیب مواد را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'combination' => 'required',
                ], [
                    'combination.required' => 'درصد ترکیب مواد را وارد کنید',
                    'masterbatch.required' => 'کد مستربچ را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'combination' => 'required',
            ], [
                'combination.required' => 'درصد ترکیب مواد را وارد کنید',
            ]);
        $color_id = StoreColor::where('id', $request->color)->first();
        if ($validator->passes()) {
            Color::updateOrCreate(['id' => $request->product_id],
                [
                    'masterbatch' => $request->masterbatchc,
                    'combination' => $request->combination,
                    'manufacturer' => $request->masterbatchn,
                    'price' => $number,
                    'color' => $request->color,
                    'name' => $color_id->name,
                    'minimum' => $request->minimum,
                    'maximum' => $request->maximum,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * حذف مشخصات گروه کالایی *
     */
    public function delete($id)
    {
        $post = Color::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش مشخصات گروه کالایی *
     */
    public function update($id)
    {
        $product = Color::find($id);
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
