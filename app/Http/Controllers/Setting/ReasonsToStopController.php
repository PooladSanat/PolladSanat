<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\ReasonsToStop;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReasonsToStopController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = ReasonsToStop::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('reason', function ($row) {
                    if ($row->reason == 1) {
                        return 'توقف فروش';
                    } elseif ($row->reason == 2) {
                        return 'توقف فنی';
                    } else {
                        return 'توقف غیر فنی';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Reasonstostop.list');

    }

    public function store(Request $request)
    {
        ReasonsToStop::updateOrCreate(['id' => $request->id],
            [
                'reason' => $request->reason,
                'type' => $request->type,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function delete($id)
    {
        $delete = ReasonsToStop::find($id);
        $delete->delete();
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function update($id)
    {
        $bank = ReasonsToStop::find($id);
        return response()->json($bank);
    }

    public function getcharacteristic(Request $request)
    {
        $states = ReasonsToStop::where("reason", $request->commodity_id)
            ->pluck("type", "id");
        return response()->json($states);
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
