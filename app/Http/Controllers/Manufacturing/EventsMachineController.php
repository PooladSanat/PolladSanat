<?php

namespace App\Http\Controllers\Manufacturing;

use App\Device;
use App\EventsMachine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class EventsMachineController extends Controller
{
    public function list(Request $request)
    {
        $devices = Device::all();
        if ($request->ajax()) {
            $data = EventsMachine::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('device_id', function ($row) {
                    return $row->device->name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'فعال';
                    } else {
                        return 'غیرفعال';
                    }
                })
                ->addColumn('shift', function ($row) {
                    if ($row->shift == 1) {
                        return 'روز';
                    } else {
                        return 'شب';
                    }
                })
                ->rawColumns([])
                ->make(true);

        }
        return view('eventsmachine.list', compact('devices'));
    }

    public function store(Request $request)
    {
        EventsMachine::create([
            'device_id' => $request->device_id,
            'time' => $request->time,
            'date' => $this->convert2english($request->date),
            'shift' => $request->shift,
            'cause' => $request->cause,
            'status' => $request->status,
            'created' => date('Y-m-d'),
        ]);
        return response()->json(['success' => 'Product saved successfully.']);


    }
    function convert2english($string) {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }

}
