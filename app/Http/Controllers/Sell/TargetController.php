<?php

namespace App\Http\Controllers\Sell;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Target;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TargetController extends Controller
{
    public function list(Request $request)
    {
        $year = Setting::first();
        if ($request->ajax()) {
            $data = Target::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('target.list', compact('year'));

    }


    public function store(Request $request)
    {
        Target::updateOrCreate(['id' => $request->id],
            [
                'farvardin' => $request->farvardin,
                'may' => $request->may,
                'June' => $request->June,
                'Arrows' => $request->Arrows,
                'August' => $request->August,
                'September' => $request->September,
                'stamp' => $request->stamp,
                'Aban' => $request->Aban,
                'Fire' => $request->Fire,
                'January' => $request->January,
                'Avalanche' => $request->Avalanche,
                'March' => $request->March,
                'user_id' => auth()->user()->id,
                'year' => $request->year,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function update($id)
    {
        $bank = Target::find($id);
        return response()->json($bank);

    }

    public function delete($id)
    {
        $delete = Target::find($id);
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
