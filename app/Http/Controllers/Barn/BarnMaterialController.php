<?php

namespace App\Http\Controllers\Barn;

use App\BarnMaterial;
use App\Http\Controllers\Controller;
use App\Polymeric;
use App\Seller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BarnMaterialController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Polymeric::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('PhysicalInventory', function ($row) {
                    $barncolor = BarnMaterial::where('polymeric_id', $row->id)
                        ->first();
                    if (!empty($barncolor->PhysicalInventory)) {
                        return $barncolor->PhysicalInventory;

                    } else {
                        return 0;
                    }

                })


                ->addColumn('PhysicalInventor', function ($row) {
                    $barncolor = BarnMaterial::where('polymeric_id', $row->id)
                        ->first();
                    if (!empty($barncolor->PhysicalInventor)) {
                        return $barncolor->PhysicalInventor;

                    } else {
                        return 0;
                    }

                })

                ->addColumn('name', function ($row) {
                    $name = Seller::where('id', $row->name)->first();
                    return $name->company;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'PhysicalInventory'])
                ->make(true);

        }
        return view('barnmaterials.list');


    }

    public function update($id)
    {
        $color = BarnMaterial::where('polymeric_id', $id)
            ->first();
        return response()->json($color);
    }

    public function store(Request $request)
    {
        BarnMaterial::updateOrCreate(['polymeric_id' => $request->id],
            [
                'polymeric_id' => $request->id,
                'PhysicalInventory' => $request->PhysicalInventory,
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
