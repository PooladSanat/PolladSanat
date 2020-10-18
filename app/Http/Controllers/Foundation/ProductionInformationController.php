<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Polymeric;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductionInformationController extends Controller
{
    public function list(Request $request)
    {
        $polymerics = Polymeric::all();
        if ($request->ajax()) {
            $data = \DB::table('production_information')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('ProductionInformation.list', compact('polymerics'));
    }

    public function store(Request $request)
    {
        $create = Carbon::now();
        \DB::table('production_information')
            ->insert([
                'name' => $request->name,
                'created_at' => $create,
            ]);
        $production = \DB::table('production_information')->latest()->first();
        $count = count($request->nameee);
        for ($i = 0; $i < $count; $i++) {
            \DB::table('detail_production_information')
                ->insert([
                    'information_id' => $production->id,
                    'materials' => $request->nameee[$i],
                    'percentage' => $request->darsaddd[$i],
                    'created_at' => $create,
                ]);
        }

        return response()->json(['success' => 'success']);

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
