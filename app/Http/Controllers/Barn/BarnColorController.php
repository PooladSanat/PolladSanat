<?php

namespace App\Http\Controllers\Barn;

use App\BarnColor;
use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BarnColorController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Color::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('PhysicalInventory', function ($row) {
                    $barncolor = BarnColor::where('color_id', $row->id)
                        ->first();
                    if (!empty($barncolor->PhysicalInventory)) {
                        return $barncolor->PhysicalInventory;
                    } else {
                        return 0;
                    }
                })
                ->addColumn('PhysicalInventor', function ($row) {
                    $barncolor = BarnColor::where('color_id', $row->id)
                        ->first();
                    if (!empty($barncolor->PhysicalInventor)) {
                        return $barncolor->PhysicalInventor;
                    } else {
                        return 0;
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'PhysicalInventory'])
                ->make(true);
        }
        return view('barncolors.list');


    }

    public function update($id)
    {
        $color = BarnColor::where('color_id', $id)
            ->first();
        return response()->json($color);
    }

    public function store(Request $request)
    {
        BarnColor::updateOrCreate(['color_id' => $request->id],
            [
                'color_id' => $request->id,
                'PhysicalInventory' => $request->PhysicalInventory,
                'PhysicalInventor' => $request->PhysicalInventor,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);


    }

    public function actions($row)
    {


        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                  <i class="fa fa-edit fa-lg" title="افزایش موجودی"></i>
                       </a>';

        return $btn;

    }

}
