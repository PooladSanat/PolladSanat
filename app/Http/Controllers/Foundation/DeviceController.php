<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Device;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;
use function App\Providers\MsgSuccess;

class DeviceController extends Controller
{
    /**
     * نمایش لیست دستگاها *
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Device::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('device.list');
    }

    /**
     * ثبت مشخصات دستگاها *
     */
    public function store(Request $request)
    {
        if (!empty($request->product)) {
            $devices = Device::find($request->product);
            if ($devices->code != $request->code) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'model' => 'required',
                ], [
                    'name.required' => 'نام دستگاه را وارد کنید',
                    'model.required' => 'مدل دستگاه را وارد کنید',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'model' => 'required',
                ], [
                    'name.required' => 'نام دستگاه را وارد کنید',
                    'model.required' => 'مدل دستگاه را وارد کنید',
                ]);
        } else
            $validator = Validator::make($request->all(), [

                'name' => 'required',
                'model' => 'required',
            ], [
                'name.required' => 'نام دستگاه را وارد کنید',
                'model.required' => 'مدل دستگاه را وارد کنید',
            ]);
        if ($validator->passes()) {
            Device::updateOrCreate(['id' => $request->product],
                [
                    'name' => $request->name,
                    'code' => $request->code,
                    'model' => $request->model,
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
        $post = Device::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش مشخصات گروه کالایی *
     */
    public function update($id)
    {
        $product = Device::find($id);
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
