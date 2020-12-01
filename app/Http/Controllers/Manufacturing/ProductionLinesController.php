<?php

namespace App\Http\Controllers\Manufacturing;

use App\Device;
use App\Format;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class ProductionLinesController extends Controller
{
    public function list(Request $request)
    {

        if ($request->ajax()) {
            $data = Device::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="برنامه های دستگاه"
                       class="device_list">
                       ' . $row->name . '
                       </a>&nbsp;&nbsp;';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == null) {
                        return 'بدون وضعیت';
                    } else {
                        return 'در حال تولید';
                    }

                })
                ->addColumn('format', function ($row) {
                    if ($row->status == null) {
                        return 'بدون وضعیت';
                    } else {
                        $production_orders = DB::table('production_orders')
                            ->where('device_id', $row->id)
                            ->where('status', 1)
                            ->first();
                        $format = DB::table('formats')
                            ->where('id', $production_orders->format_id)
                            ->first();
                        return $format->name;
                    }

                })
                ->addColumn('insert', function ($row) {
                    if ($row->status == null) {
                        return 'بدون وضعیت';
                    } else {
                        $production_orders = DB::table('production_orders')
                            ->where('device_id', $row->id)
                            ->where('status', 1)
                            ->first();

                        if ($production_orders->insert_id == 0) {
                            return 'بدون اینسرت';
                        } else {
                            $format = DB::table('inserts')
                                ->where('id', $production_orders->insert_id)
                                ->first();
                            return $format->name;
                        }


                    }

                })
                ->addColumn('final', function ($row) {
                    if ($row->status == null) {
                        return '0';
                    } else {
                        $production_orders = DB::table('production_orders')
                            ->where('device_id', $row->id)
                            ->where('status', 1)
                            ->first();
                        $product = DB::table('production_store')
                            ->where('id_production', $production_orders->id)
                            ->sum('hnumber');
                        return $production_orders->number - $product;
                    }


                })
                ->addColumn('finaltime', function ($row) {


                    $production_orders = DB::table('production_orders')
                        ->where('device_id', $row->id)
                        ->where('status', 1)
                        ->first();

                    if (!empty($production_orders)) {
                        $product = DB::table('production_store')
                            ->where('id_production', $production_orders->id)
                            ->sum('hnumber');

                        $number = $production_orders->number - $product;

                        if (!empty($production_orders->stime)) {
                            $namee = Format::where('id', $production_orders->format_id)->first();
                            $tt = $number / $namee->quetta;
                            $vv = $tt * $production_orders->stime;
                            $productiontime = $vv;
                        } else {
                            $format = DB::table('model_products')
                                ->where('product_id', $production_orders->product_id)
                                ->first();
                            $name = Format::where('id', $production_orders->format_id)->first();
                            $t = $number / $name->quetta;
                            $v = $t * $format->cycletime;
                            $productiontime = $v;
                        }
                        $days = intval(intval($productiontime) / (3600 * 24));
                        $h = intval($productiontime % (24 * 3600));
                        $hour = intval($h / 3600);
                        $m = intval($h % 3600);
                        $minutes = intval($m / 60);
                        $seconds = intval($m % 60);
                        if ($productiontime >= 86400) {
                            return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                        } elseif ($productiontime >= 3600) {
                            return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                        } else {
                            return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                        }
                    } else {
                        return 'بدون وضعیت';
                    }


                })
                ->rawColumns(['name'])
                ->make(true);

        }
        return view('ProductionLines.list');
    }

    public function DeviceList(Request $request)
    {

        if ($request->ajax()) {
            $data = \DB::table('production_orders')
                ->where('device_id', $request->device_id)
                ->orderBy('order', 'ASC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = DB::table('products')
                        ->where('id', $row->product_id)
                        ->first();
                    return $product->label;

                })
                ->addColumn('color', function ($row) {
                    $product = DB::table('colors')
                        ->where('id', $row->color_id)
                        ->first();
                    return $product->name;

                })
                ->addColumn('hnumber', function ($row) {
                    $product = DB::table('production_store')
                        ->where('id_production', $row->id)
                        ->sum('hnumber');
                    return $product;

                })
                ->addColumn('status', function ($row) {
                    if ($row->status == null) {
                        return "بدون وضعیت";
                    } elseif ($row->status == 1) {
                        return "در حال تولید";
                    }
                })
                ->addColumn('final', function ($row) {
                    $product = DB::table('production_store')
                        ->where('id_production', $row->id)
                        ->sum('hnumber');

                    return $row->number - $product;

                })
                ->addColumn('qc', function ($row) {

                    $qc_productio = DB::table('qc_production')
                        ->where('id_production', $row->id)
                        ->first();
                    if (!empty($qc_productio)) {
                        if ($qc_productio->status == 1) {
                            return 'تایید شده';
                        } else {
                            return 'تایید نشده';
                        }
                    } else {
                        return 'در انتظار جواب qc';
                    }


                })
                ->addColumn('actions', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('ViewProduction.list');
    }

    public function Devicestop(Request $request)
    {

        if ($request->ajax()) {
            $data = \DB::table('production_stop')
                ->where('device_id', $request->device_id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    $user = DB::table('users')
                        ->where('id', $row->user_id)
                        ->first();
                    return $user->name;

                })
                ->addColumn('inndate', function ($row) {

                    return $row->indate . ' ' . $row->intime;

                })
                ->addColumn('toodate', function ($row) {

                    return $row->todate . ' ' . $row->totime;

                })
                ->addColumn('ago', function ($row) {

                    $time1 = $row->indate . " " . $row->intime . '' . ":00";
                    $time2 = $row->todate . " " . $row->totime . '' . ":00";
                    $dateTime1 = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $time1);
                    $dateTime2 = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $time2);
                    $v = Carbon::make($dateTime1);
                    $vv = Carbon::make($dateTime2);
                    $diff = abs(strtotime($vv) - strtotime($v));
                    $days = intval(intval($diff) / (3600 * 24));
                    $h = intval($diff % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($diff >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } elseif ($diff >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    }


                })
                ->addColumn('for', function ($row) {
                    $format = DB::table('formats')
                        ->where('id', $row->format_id)
                        ->first();
                    return $format->name;

                })
                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('ViewProduction.list');
    }

    public function DeviceListProduction(Request $request)
    {
        if ($request->ajax()) {
            $data = \DB::table('production_store')
                ->where('id_production', $request->device_id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    $user = DB::table('users')
                        ->where('id', $row->user_id)
                        ->first();
                    return $user->name;

                })
                ->addColumn('shift', function ($row) {
                    if ($row->shift == 1) {
                        return 'صبح';
                    } else {
                        return 'شب';
                    }

                })
                ->addColumn('actio', function ($row) {
                    return $this->actio($row);
                })
                ->rawColumns(['actio'])
                ->make(true);
        }
        return view('ViewProduction.list');

    }

    public function pishtlid(Request $request)
    {

        $date = Jalalian::now()->format('Y/m/d');
        $create = Carbon::now();

        DB::table('pre_production')
            ->insert([
                'id_production' => $request->id_pishtolid,
                'number' => $request->number_pish,
                'user_id' => auth()->user()->id,
                'date' => $date,
                'created_at' => $create,
            ]);

        return response()->json(['success' => 'success']);
    }

    public function listpish(Request $request)
    {

        if ($request->ajax()) {
            $data = \DB::table('pre_production')
                ->where('id_production', $request->device_id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    $product = DB::table('users')
                        ->where('id', $row->user_id)
                        ->first();
                    return $product->name;

                })
                ->addColumn('qc', function ($row) {
                    return 'در انتظار qc';

                })
                ->addColumn('actioonn', function ($row) {
                    return $this->actioonn($row);
                })
                ->rawColumns(['actioonn'])
                ->make(true);
        }
        return view('ViewProduction.list');


    }


    public function check(Request $request)
    {
        $date = Jalalian::now()->format('Y/m/d');

        $data = DB::table('production_orders')
            ->where('id', $request->id)
            ->first();

        $production_store = DB::table('production_store')
            ->where('id_production', $data->id)
            ->sum('hnumber');

        $stime = DB::table('model_products')
            ->where('product_id', $data->product_id)
            ->first();

        $product = DB::table('products')
            ->where('id', $data->product_id)
            ->first();
        $color = DB::table('colors')
            ->where('id', $data->color_id)
            ->first();
        $products = $product->label . ' ' . $color->name;

        return response()->json(['data' => $data, 'product' => $products,
            'production_store' => $production_store, 'stime' => $stime, 'date' => $date]);

    }

    public function storeStop(Request $request)
    {
        $date = Jalalian::now()->format('Y/m/d');
        DB::table('production_stop')
            ->insert([
                'user_id' => auth()->user()->id,
                'device_id' => $request->id_device,
                'format_id' => $request->format_id,
                'date' => $date,
                'indate' => $request->indate,
                'todate' => $request->todate,
                'intime' => $request->intime,
                'totime' => $request->totime,
                'typestop' => $request->typestop,
                'desstop' => $request->desstop,
                'description' => $request->description,
            ]);
        return response()->json(['success' => 'success']);

    }

    public function store(Request $request)
    {
        $sum = $request->numberproduceds[0] + $request->hnumberr[0];
        if ($sum > $request->totalnumberr[0]) {
            return response()->json(['rrrrerror' => 'rrrrerror']);
        }

        DB::table('production_store')
            ->insert([
                'user_id' => auth()->user()->id,
                'id_production' => $request->id_id,
                'shift' => $request->shift,
                'date' => $request->date,
                'hnumber' => $request->hnumberr[0],
                'gnumber' => $request->gnumberr[0],
                'wnumber' => $request->wnumberr[0],
            ]);

        DB::table('production_orders')
            ->where('id', $request->id_id)
            ->update([
                'stime' => $request->stimee[0],
            ]);

        return response()->json(['success' => 'success']);

    }

    public function actions($row)
    {
        $btn = null;
        $qc_productio = DB::table('qc_production')
            ->where('id_production', $row->id)
            ->first();
        if (!empty($qc_productio)) {
            if ($qc_productio->status == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkProduct">
                       <i class="fa fa-stop fa-lg" title="توقف"></i>
                       </a>&nbsp;&nbsp;';

                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="product">
                       <i class="fa fa-pause fa-lg" title="وقفه"></i>
                       </a>&nbsp;&nbsp;';

                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="play_product">
                       <i class="fa fa-play fa-lg" title="شروع"></i>
                       </a>&nbsp;&nbsp;';

                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="store_information">
                       <i class="fa fa-file-text fa-lg" title="ثبت اطلاعات تولید"></i>
                       </a>&nbsp;&nbsp;';

                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ثبت پیش تولید"
                       class="pish_tolid">
                       <i class="fa fa-pinterest fa-lg" title="ثبت پیش تولید"></i>
                       </a>&nbsp;&nbsp;';

                $btn = $btn . '<a href="' . route('admin.viewproduct.print', $row->id) . '" target="_blank">
                       <i class="fa fa-eye fa-lg" title="چاپ جزییات برنامه تولید"></i>
                       </a>&nbsp;&nbsp;';
            } else {
                $btn = null;
            }
        } else {
            $btn = null;
        }
        return $btn;
    }

    public function actionss($row)
    {
        $btn = null;

        $btn = $btn . '<a href="' . route('admin.viewproduct.print', $row->id) . '" target="_blank">
                       <i class="fa fa-eye fa-lg" title="چاپ جزییات برنامه تولید"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;
    }

    public function action($row)
    {
        $btn = null;


        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkedit">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkdelete">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;
    }

    public function actio($row)
    {
        $btn = null;


        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkedit">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkdelete">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;
    }


    public function actioonn($row)
    {
        $btn = null;


        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkedit">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkdelete">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;
    }

}
