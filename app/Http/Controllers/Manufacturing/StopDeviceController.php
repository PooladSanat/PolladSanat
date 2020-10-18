<?php

namespace App\Http\Controllers\Manufacturing;

use App\Format;
use App\Http\Controllers\Controller;
use App\Insert;
use App\ReasonsToStop;
use App\StopDevice;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class StopDeviceController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = StopDevice::where('device_id', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Minutes', function ($row) {
                    $start = Carbon::parse($row->date);
                    $end = Carbon::parse($row->todate);
                    $Minutes = $end->diffInMinutes($start);
                    return $Minutes;
                })
                ->addColumn('reasons', function ($row) {
                    if ($row->reasons == 1) {
                        return 'توقف فروش';
                    } elseif ($row->reasons == 2) {
                        return 'توقف فنی';
                    } else {
                        return 'توقف غیر فنی';
                    }
                })
                ->addColumn('user_id', function ($row) {
                    $user = User::where('id', $row->user_id)->first();
                    return $user->name;
                })
                ->addColumn('format_id', function ($row) {
                    $user = Format::where('id', $row->format_id)->first();
                    if (!empty($user)) {
                        return $user->name;
                    } else {
                        return '-----';
                    }

                })
                ->addColumn('insert_id', function ($row) {
                    $user = Insert::where('id', $row->insert_id)->first();
                    if (!empty($user)) {
                        return $user->name;
                    } else {
                        return '-----';
                    }

                })
                ->addColumn('description', function ($row) {
                    if (!empty($row->description)) {
                        return $row->description;
                    } else {
                        return '-----';
                    }

                })
                ->addColumn('reasons_id', function ($row) {
                    $name = ReasonsToStop::where('id', $row->reasons_id)->first();
                    return $name->type;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('manufacturing.list');

    }

    public function stop1(Request $request)
    {


        $r = $this->convert2english($request->date) . ' ' . $request->time . ':00';
        $t = $this->convert2english($request->todate) . ' ' . $request->totime . ':00';
        $datenow = Carbon::parse($r)->format('Y/m/d');
        $start = Carbon::parse($r);
        $end = Carbon::parse($t);
        $Minutes = $end->diffInMinutes($start);
        if ($request['format'] == 0) {
            $format = null;
        } else {
            $format = $request['format'];
        }
        if ($request['insert'] == 0) {
            $insert = null;
        } else {
            $insert = $request['insert'];
        }
        if (!empty($request['idd'])) {

            StopDevice::find($request['idd'])->update([
                'format_id' => $format,
                'reasons_id' => $request['type'],
                'device_id' => 1,
                'order_id' => $request['order_id_stop'],
                'reasons' => $request['reason'],
                'insert_id' => $insert,
                'user_id' => auth()->user()->id,
                'description' => $request['description'],
                'date' => $r,
                'todate' => $t,
                'minutes' => $Minutes,
                'datenow' => $datenow,
                'indate' => $this->convert2english($request->date),
                'tordate' => $this->convert2english($request->todate),
                'time' => $request->time,
                'totime' => $request->totime,
            ]);
            return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);

        } else {
            StopDevice::create([
                'format_id' => $format,
                'reasons_id' => $request['type'],
                'device_id' => 1,
                'order_id' => $request['order_id_stop'],
                'reasons' => $request['reason'],
                'insert_id' => $insert,
                'user_id' => auth()->user()->id,
                'description' => $request['description'],
                'date' => $r,
                'todate' => $t,
                'minutes' => $Minutes,
                'datenow' => $datenow,
                'indate' => $this->convert2english($request->date),
                'tordate' => $this->convert2english($request->todate),
                'time' => $request->time,
                'totime' => $request->totime,
            ]);
        }
        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);


    }

    function convert2english($string)
    {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }

    public function delete1($id)
    {
        $data = StopDevice::find($id)->first();
        $data->delete();
        return response()->json($data);

    }

    public function edit1($id)
    {

        $data = StopDevice::where('id', $id)->first();
        return response()->json($data);

    }

    public function actions($row)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="edit_stop1">
                      <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                      </a>&nbsp;&nbsp;';
        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="delete_stop1">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        return $btn;

    }


}
