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

class QualityControlController extends Controller
{

    public function listt(Request $request)
    {

        if ($request->ajax()) {
            $data = Device::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="برنامه های دستگاه"
                       class="device_listt">
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
        return view('Qc.list');
    }

    public function DeviceListt(Request $request)
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

                    return 'در انتظار جواب qc';

                })
                ->addColumn('actions', function ($row) {
                    return $this->actionss($row);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('Qc.list');
    }

    public function actions($row)
    {
        $btn = null;


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

        $btn = $btn . '<a href="' . route('admin.viewproduct.print', $row->id) . '" target="_blank">
                       <i class="fa fa-eye fa-lg" title="چاپ جزییات برنامه تولید"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;
    }

    public function actionss($row)
    {
        $btn = null;

        $btn = $btn . '<a href="' . route('admin.viewproduct.printt', $row->id) . '" target="_blank">
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

}


