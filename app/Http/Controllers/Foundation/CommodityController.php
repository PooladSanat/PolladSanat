<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Commodity;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;
use function App\Providers\MsgError;
use function App\Providers\MsgSuccess;

class CommodityController extends Controller
{
    /**
     * نمایش لیست گروهای کالایی *
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Commodity::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('CommodityGroup.list');
    }

    /**
     * ثبت مشخصات گروه های کالایی *
     */
    public function store(Request $request)
    {
        if (!empty($request->product_id)) {
            $commoditys = Commodity::find($request->product_id);
            if ($request->code != $commoditys->code) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ], [
                    'name.required' => 'لطفا نام گروه کالایی را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ], [
                    'name.required' => 'لطفا نام گروه کالایی را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ], [
                'name.required' => 'لطفا نام گروه کالایی را وارد کنید',
            ]);


        if ($validator->passes()) {
            Commodity::updateOrCreate(['id' => $request->product_id],
                [
                    'name' => $request->name,
                    'code' => $request->code
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
        $post = Commodity::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش مشخصات گروه کالایی *
     */
    public function update($id)
    {

        $product = Commodity::find($id);
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
