<?php

namespace App\Http\Controllers\Foundation;

use App\Areas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Validator;
use Yajra\DataTables\DataTables;

class AreasController extends Controller
{
    public function list(Request $request)
    {
        $countrys = \DB::table('country')->get();

        if ($request->ajax()) {
            $data = Areas::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('country_id', function ($row) {
                    $id = \DB::table('country')
                        ->where('country_id', $row->country_id)
                        ->first();
                    return $id->name;
                })
                ->addColumn('city', function ($row) {
                    $id = \DB::table('zone')
                        ->where('zone_id', $row->state_id)
                        ->first();
                    return $id->name;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('areas.list', compact('countrys'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'city' => 'required',
            'areas' => 'required',
        ], [
            'country.required' => 'لطفا کشور را انتخاب کنید',
            'city.required' => 'لطفا استان را انتخاب کنید',
            'areas.required' => 'لطفا نام منطقه را وارد کنید',
        ]);
        if ($validator->passes()) {
            Areas::updateOrCreate(['id' => $request->product_id],
                [
                    'country_id' => $request->country,
                    'state_id' => $request->city,
                    'areas' => $request->areas,
                ]);
            return response()->json(['success' => 'success']);
        }
        return Response::json(['errors' => $validator->errors()]);


    }

    public function update($id)
    {
        $product = Areas::find($id);
        return response()->json($product);
    }

    public function delete($id)
    {
        $post = Areas::findOrFail($id);
        $post->delete();
        return response()->json($post);
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
