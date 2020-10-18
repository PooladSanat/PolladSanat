<?php

namespace App\Http\Controllers\Foundation;

use App\Color;
use App\ColorScrap;
use App\Format;
use App\Http\Controllers\Controller;
use App\Product;
use App\StoreColor;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Yajra\DataTables\DataTables;

class ColorScrapController extends Controller
{
    public function list(Request $request)
    {
        $Formats = Format::all();
        $colors = Color::all();

        if ($request->ajax()) {
            $data = ColorScrap::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('format_id', function ($row) {
                    return $row->format->name;
                })
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
        return view('ColorScrap.list', compact('Formats', 'colors'));

    }

    public function delete($id)
    {
        $delete = ColorScrap::find($id);
        $delete->delete();
        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function store(Request $request)
    {
        ColorScrap::updateOrCreate(['id' => $request->id],
            [
                'format_id' => $request->format_id,
                'ofColor_id' => $request->ofColor_id,
                'toColor_id' => $request->toColor_id,
                'usable' => $request->usable,
                'unusable' => $request->unusable,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function update($id)
    {
        $bank = ColorScrap::find($id);
        return response()->json($bank);

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
