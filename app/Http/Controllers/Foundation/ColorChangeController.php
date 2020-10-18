<?php

namespace App\Http\Controllers\Foundation;

use App\Color;
use App\ColorChange;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ColorChangeController extends Controller
{
    public function list(Request $request)
    {
        $colors = Color::all();
        if ($request->ajax()) {
            $data = ColorChange::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ofColor_id', function ($row) {
                    $ofColor_id = Color::where('id', $row->ofColor_id)->first();
                    return $ofColor_id->manufacturer . ' - ' . $ofColor_id->name;
                })
                ->addColumn('toColor_id', function ($row) {
                    $toColor_id = Color::where('id', $row->toColor_id)->first();
                    return $toColor_id->manufacturer . ' - ' . $toColor_id->name;
                })

                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('colorchange.list', compact('colors'));

    }

    public function store(Request $request)
    {
        ColorChange::updateOrCreate(['id' => $request->id],
            [
                'ofColor_id' => $request->ofColor_id,
                'toColor_id' => $request->toColor_id,
                'time' => $request->time,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function update($id)
    {
        $bank = ColorChange::find($id);
        return response()->json($bank);

    }
    public function delete($id)
    {
        $delete = ColorChange::find($id);
        $delete->delete();
        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function actions($row)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
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
