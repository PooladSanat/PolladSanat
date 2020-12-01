<?php

namespace App\Http\Controllers\Manufacturing;

use App\BarnsProduct;
use App\BarnTemporary;
use App\Color;
use App\Device;
use App\Format;
use App\Http\Controllers\Controller;
use App\Insert;
use App\Product;
use App\ProductionOrder;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class ViewProductController extends Controller
{

    public function list(Request $request)
    {

        $products = Product::where('label', 'NOT LIKE', "%D2%")->get();
        $colors = Color::all();
        $devices = Device::all();
        $formats = Format::all();
        $inserts = Insert::all();
        $informations = \DB::table('production_information')
            ->orderBy('id', 'DESC')
            ->get();

        $detail_production_information = DB::table('detail_production_information')
            ->get();


        if ($request->ajax()) {

            $data = DB::table('products')
                ->where('label', 'NOT LIKE', "%D2%")
                ->crossJoin('colors')
                ->distinct()
                ->select('colors.id as color_id', 'products.id', 'products.label')
                ->groupBy('colors.id', 'products.id', 'products.label')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('minimum', function ($row) {
                    $minimums = Product::where('id', $row->id)
                        ->get();
                    foreach ($minimums as $minimum)
                        return $minimum->minimum;
                })
                ->addColumn('maximum', function ($row) {
                    $maximums = Product::where('id', $row->id)
                        ->get();
                    foreach ($maximums as $maximum)
                        return $maximum->maximum;
                })
                ->addColumn('product_color', function ($row) {
                    $colors = Color::where('id', $row->color_id)->get();
                    foreach ($colors as $color)
                        if (!empty($color)) {
                            $c = $color->name;
                        }
                    return $row->label . ' _ ' . $c;
                })
                ->addColumn('color', function ($row) {
                    $colors = Color::where('id', $row->color_id)->get();
                    foreach ($colors as $color)
                        if (!empty($color)) {
                            return $color->name;
                        } else {
                            return '---';
                        }
                })
                ->addColumn('Inventory', function ($row) {
                    $Inventory = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventory');
                    $Inventor = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventor');
                    $sum = $Inventor + $Inventory;
                    $NumberSold = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('NumberSold');

                    if (!empty($Inventory)) {
                        return $sum - $NumberSold;
                    } else {
                        return '0';
                    }
                })
                ->addColumn('frosh', function ($row) {
                    $frosh = DB::table('invoice_product')
                        ->where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->where('state', 1)
                        ->whereNull('end')
                        ->sum('salesNumber');
                    return $frosh;
                })
                ->addColumn('device', function ($row) {
                    $device_name = array();
                    $devices = array();
                    $production_orders = DB::table('production_orders')
                        ->where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->get();
                    foreach ($production_orders as $production_order) {
                        $device_name[] = $production_order->device_id;
                    }
                    if (!empty($device_name)) {
                        $device = DB::table('devices')
                            ->whereIn('id', $device_name)
                            ->get();
                        $count = count($device);
                        if ($count == 1) {
                            $devices = 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[0]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[0]->name . '
                       </a>';
                        } else if ($count == 2) {
                            $devices = 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[0]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[0]->name . '
                       </a>';
                            $devices = $devices . 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[1]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[1]->name . '
                       </a>';
                        } else if ($count == 3) {
                            $devices = 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[0]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[0]->name . '
                       </a>';
                            $devices = $devices . 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[1]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[1]->name . '
                       </a>';
                            $devices = $devices . 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[2]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[2]->name . '
                       </a>';
                        } else if ($count == 4) {
                            $devices = 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[0]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[0]->name . '
                       </a>';
                            $devices = $devices . 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[1]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[1]->name . '
                       </a>';
                            $devices = $devices . 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[2]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[2]->name . '
                       </a>';
                            $devices = $devices . 'دستگاه' . " " . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $device[3]->id . '" data-original-title="برنامه جدید"
                       class="new_device">
                       ' . $device[3]->name . '
                       </a>';
                        } else {
                            $devices = "";
                        }
                    }
                    return $devices;

                })
                ->addColumn('format', function ($row) {
                    $device_name = array();
                    $devices = array();
                    $production_orders = DB::table('production_orders')
                        ->where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->get();
                    foreach ($production_orders as $production_order) {
                        $device_name[] = $production_order->format_id;
                    }
                    if (!empty($device_name)) {
                        $device = DB::table('formats')
                            ->whereIn('id', $device_name)
                            ->get();

                        $count = count($device);

                        if ($count == 1) {
                            $devices = 'قالب' . " " . $device[0]->name . ' ';
                        } else if ($count == 2) {
                            $devices = 'قالب' . " " . $device[0]->name . ' ';
                            $devices = $devices . 'قالب' . " " . $device[1]->name . ' ';
                        } else if ($count == 3) {
                            $devices = 'قالب' . " " . $device[0]->name . ' ';
                            $devices = $devices . 'قالب' . " " . $device[1]->name . ' ';
                            $devices = $devices . 'قالب' . " " . $device[2]->name . ' ';
                        } else if ($count == 4) {
                            $devices = 'قالب' . " " . $device[0]->name . ' ';
                            $devices = $devices . 'قالب' . " " . $device[1]->name . " ";
                            $devices = $devices . 'قالب' . " " . $device[2]->name . ' ';
                            $devices = $devices . 'قالب' . " " . $device[3]->name . ' ';
                        } else {
                            $devices = "";
                        }
                    }
                    return $devices;

                })
                ->addColumn('number', function ($row) {
                    $production_orders = DB::table('production_orders')
                        ->where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('number');
                    return $production_orders;
                })
                ->addColumn('tolid', function ($row) {
                    $Inventory = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventory');
                    $Inventor = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventor');

                    $NumberSold = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('NumberSold');

                    $sum = $Inventory + $Inventor - $NumberSold;
                    $maximums = Product::where('id', $row->id)
                        ->first();
                    return $maximums->maximum - $sum;
                })
                ->addColumn('sum', function ($row) {
                    $barntemporary = BarnTemporary::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('number');
                    $Orderinprogress = ProductionOrder::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('number');
                    $Inventory = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventory');

                    return $barntemporary + $Orderinprogress + $Inventory;
                })
                ->addColumn('action', function ($row) {
                    return $this->action($row);
                })
                ->rawColumns(['action', 'device'])
                ->make(true);
        }
        return view('ViewProduction.list', compact('products',
            'colors', 'devices', 'formats', 'inserts', 'informations'
            , 'detail_production_information'));
    }

    public function device(Request $request)
    {

        $data = DB::table('devices')
            ->where('id', $request->id)
            ->first();
        return response()->json($data);
    }

    public function DeviceList(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('production_orders')
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
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('color', function ($row) {
                    $product = DB::table('colors')
                        ->where('id', $row->color_id)
                        ->first();
                    return $product->name;

                })
                ->addColumn('start', function ($row) {
                    $order = DB::table('production_details')
                        ->where('order_id', $row->id)
                        ->first();
                    if (!empty($order)) {
                        $date = Jalalian::forge($order->start_time)->format('Y/m/d H:i:s');
                        return $date;
                    } else {
                        return "";
                    }

                })
                ->addColumn('status', function ($row) {
                    if ($row->status == null) {
                        return "بدون وضعیت";
                    } elseif ($row->status == 1) {
                        return "در حال تولید";
                    }
                })
                ->addColumn('startt', function ($row) {
                    date_default_timezone_set('Asia/Tehran');

                    $ste = DB::table('production_orders')
                        ->whereNotNull('start')
                        ->first();

                    if (!empty($ste)) {
                        if (!empty($row->date_start)) {
                            $date_startt = $row->date_start;
                            $time_startt = $row->time_start;
                            $vvv = $date_startt . " " . $time_startt . '' . ":00";
                            return $vvv;
                        } else {
                            $orderss = DB::table('production_orders')
                                ->where('device_id', $row->device_id)
                                ->where('order', '<', $row->order)
                                ->latest('order')->first();
                            if (!empty($orderss)) {
                                $ordersss = DB::table('production_orders')
                                    ->where('device_id', $orderss->device_id)
                                    ->where('order', '<', $orderss->order)
                                    ->latest('order')->first();

                                if (!empty($ordersss)) {
                                    $rr = $ordersss->productiontime;
                                } else {
                                    $rr = null;
                                }


                                $order = DB::table('production_orders')
                                    ->where('device_id', '=', $row->device_id)
                                    ->whereNotNull('order')
                                    ->first();

                                if ($orderss->start == null) {
                                    $orderssa = DB::table('production_orders')
                                        ->where('device_id', $orderss->device_id)
                                        ->where('order', '<', $orderss->order)
                                        ->whereNotNull('start')
                                        ->latest('order')->first();
                                    if (!empty($orderssa)) {
                                        $date_start = $orderssa->date_start;
                                        $time_start = $orderssa->time_start;
                                    } else {
                                        $date_start = $orderss->date_start;
                                        $time_start = $orderss->time_start;
                                    }
                                } else {
                                    $date_start = $orderss->date_start;
                                    $time_start = $orderss->time_start;
                                }


                                if (!empty($orderss->time_start)) {
                                    $date_begin = "1999/01/01" . ' ' . $orderss->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $orderss->time_start;
                                    $ooo = $orderss->date_start;
                                } else {
                                    $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $order->time_start;
                                    $ooo = $order->date_start;
                                }
                                $dffsf = $orderss->productiontime + $rr;
                                if ($dffsf > $seconds) {

                                    $ff = $dffsf - $seconds;
                                    $date = date($ooo);
                                    $newdate = strtotime('+1 day', strtotime($date));
                                    $newdatee = date('Y/m/d', $newdate);
                                    $gg = $ff / 43200;
                                    $ggg = floor($gg);
                                    $datee = date($newdatee);
                                    $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                    $newdattee = date('Y/m/d', $newdatte);
                                    $trtr = $gg - $ggg;
                                    $ref = $trtr * 43200 / 60;
                                    $Rr = ceil($ref);
                                    $h = intval($Rr % (12 * 3600));
                                    $hour = intval($h / 3600);
                                    $m = intval($h % 3600);
                                    $minutes = intval($m / 60);
                                    $seconds = intval($m % 60);
                                    $time = "07:20:00";
                                    $time2 = $minutes . ":" . $seconds . ":" . "00";
                                    $secs = strtotime($time2) - strtotime("00:00:00");
                                    $result = date("H:i:s", strtotime($time) + $secs);
                                    return $newdattee . " " . $result;

                                } else {
                                    $vv = $date_start . " " . $time_start . '' . ":00";
                                    $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                    $v = Carbon::make($dateTime);
                                    $sum = $orderss->productiontime + $orderss->format_time + $orderss->insert_time + $orderss->color_time;
                                    $number = strtotime($v);
                                    $f = $sum + $number;
                                    $date = date('Y/m/d H:i:s', $f);
                                    $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                    return $y;
                                }
                            } else {
                                $date_startt = $row->date_start;
                                $time_startt = $row->time_start;
                                $vvv = $date_startt . " " . $time_startt . '' . ":00";
                                return $vvv;
                            }


                        }
                    } else {
                        return '';
                    }


                })
                ->addColumn('productiontime', function ($row) {
                    date_default_timezone_set('Asia/Tehran');
                    $orderss = DB::table('production_orders')
                        ->where('device_id', $row->device_id)
                        ->where('order', '<', $row->order)
                        ->latest('order')->first();


                    if ($row->start == null) {
                        $orders = DB::table('production_orders')
                            ->where('device_id', $row->device_id)
                            ->where('order', '<', $row->order)
                            ->whereNotNull('start')
                            ->latest('order')->first();
                        if (!empty($orders)) {
                            $start = $orders->start;
                            $date_start = $orders->date_start;
                            $time_start = $orders->time_start;
                        } else {
                            $start = $row->start;
                            $date_start = $row->date_start;
                            $time_start = $row->time_start;
                        }
                    } else {
                        $start = $row->start;
                        $date_start = $row->date_start;
                        $time_start = $row->time_start;
                    }
                    $order = DB::table('production_orders')
                        ->where('device_id', '=', $row->device_id)
                        ->whereNotNull('order')
                        ->first();
                    if (!empty($order)) {
                        $check = DB::table('production_orders')
                            ->where('order', '<', $row->order)
                            ->where('device_id', '=', $row->device_id)
                            ->latest()
                            ->first();
                        if (!empty($check)) {
                            $time = $check->productiontime;
                        } else {
                            $time = 0;
                        }
                    } else {
                        $time = 0;
                    }

                    if (!empty($date_start)) {

                        if (empty($orderss)) {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }

                            if ($row->productiontime > $seconds) {

                                $ff = $row->productiontime - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        } else {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }
                            $dffsf = $orderss->productiontime + $row->productiontime;
                            if ($dffsf > $seconds) {

                                $ff = $dffsf - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        }


                    } else {
                        return '';
                    }


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
//                ->addColumn('finaltime', function ($row) {
//
//                    $product = DB::table('production_store')
//                        ->where('id_production', $row->id)
//                        ->sum('hnumber');
//                    $number = $row->number - $product;
//                    if (!empty($row->stime)) {
//                        $namee = Format::where('id', $row->format_id)->first();
//                        $tt = $number / $namee->quetta;
//                        $vv = $tt * $row->stime;
//                        $productiontime = $vv;
//                    } else {
//                        $format = DB::table('model_products')
//                            ->where('product_id', $row->product_id)
//                            ->first();
//                        $name = Format::where('id', $row->format_id)->first();
//                        $t = $number / $name->quetta;
//                        $v = $t * $format->cycletime;
//                        $productiontime = $v;
//                    }
//                    $days = intval(intval($productiontime) / (3600 * 12));
//                    $h = intval($productiontime % (12 * 3600));
//                    $hour = intval($h / 3600);
//                    $m = intval($h % 3600);
//                    $minutes = intval($m / 60);
//                    $seconds = intval($m % 60);
//                    if ($productiontime >= 43200) {
//                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } elseif ($productiontime >= 3600) {
//                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } else {
//                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    }
//                })
                ->addColumn('actions', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('ViewProduction.list');
    }

    public function listdevices(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('production_orders')
                ->where('device_id', $request->device_id)
                ->orderBy('order', 'ASC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
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
                ->addColumn('product_color', function ($row) {
                    $product = DB::table('products')
                        ->where('id', $row->product_id)
                        ->first();

                    $color = DB::table('colors')
                        ->where('id', $row->color_id)
                        ->first();

                    return $product->label . "_" . $color->name;

                })
                ->addColumn('start', function ($row) {
                    $order = DB::table('production_details')
                        ->where('order_id', $row->id)
                        ->first();
                    if (!empty($order)) {
                        $date = Jalalian::forge($order->start_time)->format('Y/m/d H:i:s');
                        return $date;
                    } else {
                        return "";
                    }

                })
                ->addColumn('status', function ($row) {
                    if ($row->status == null) {
                        return "بدون وضعیت";
                    } elseif ($row->status == 1) {
                        return "در حال تولید";
                    }
                })
                ->addColumn('mstatus', function ($row) {
                    return '----';
                })
                ->addColumn('tstatus', function ($row) {
                    return '----';
                })
                ->addColumn('format', function ($row) {
                    $format = DB::table('formats')
                        ->where('id', $row->format_id)
                        ->first();
                    return $format->name;
                })
                ->addColumn('insert', function ($row) {
                    if ($row->insert_id == 0) {
                        return 'بدون اینسرت';
                    } else {
                        $format = DB::table('inserts')
                            ->where('id', $row->insert_id)
                            ->first();
                        return $format->name;
                    }

                })
                ->addColumn('total', function ($row) {
                    $total = DB::table('production_store')
                        ->where('id_production', $row->id)
                        ->sum('hnumber');
                    return $row->number - $total;

                })
                ->addColumn('startt', function ($row) {
                    date_default_timezone_set('Asia/Tehran');

                    $ste = DB::table('production_orders')
                        ->whereNotNull('start')
                        ->first();

                    if (!empty($ste)) {
                        if (!empty($row->date_start)) {
                            $date_startt = $row->date_start;
                            $time_startt = $row->time_start;
                            $vvv = $date_startt . " " . $time_startt . '' . ":00";
                            return $vvv;
                        } else {
                            $orderss = DB::table('production_orders')
                                ->where('device_id', $row->device_id)
                                ->where('order', '<', $row->order)
                                ->latest('order')->first();
                            if (!empty($orderss)) {
                                $ordersss = DB::table('production_orders')
                                    ->where('device_id', $orderss->device_id)
                                    ->where('order', '<', $orderss->order)
                                    ->latest('order')->first();

                                if (!empty($ordersss)) {
                                    $rr = $ordersss->productiontime;
                                } else {
                                    $rr = null;
                                }


                                $order = DB::table('production_orders')
                                    ->where('device_id', '=', $row->device_id)
                                    ->whereNotNull('order')
                                    ->first();

                                if ($orderss->start == null) {
                                    $orderssa = DB::table('production_orders')
                                        ->where('device_id', $orderss->device_id)
                                        ->where('order', '<', $orderss->order)
                                        ->whereNotNull('start')
                                        ->latest('order')->first();
                                    if (!empty($orderssa)) {
                                        $date_start = $orderssa->date_start;
                                        $time_start = $orderssa->time_start;
                                    } else {
                                        $date_start = $orderss->date_start;
                                        $time_start = $orderss->time_start;
                                    }
                                } else {
                                    $date_start = $orderss->date_start;
                                    $time_start = $orderss->time_start;
                                }


                                if (!empty($orderss->time_start)) {
                                    $date_begin = "1999/01/01" . ' ' . $orderss->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $orderss->time_start;
                                    $ooo = $orderss->date_start;
                                } else {
                                    $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $order->time_start;
                                    $ooo = $order->date_start;
                                }
                                $dffsf = $orderss->productiontime + $rr;
                                if ($dffsf > $seconds) {

                                    $ff = $dffsf - $seconds;
                                    $date = date($ooo);
                                    $newdate = strtotime('+1 day', strtotime($date));
                                    $newdatee = date('Y/m/d', $newdate);
                                    $gg = $ff / 43200;
                                    $ggg = floor($gg);
                                    $datee = date($newdatee);
                                    $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                    $newdattee = date('Y/m/d', $newdatte);
                                    $trtr = $gg - $ggg;
                                    $ref = $trtr * 43200 / 60;
                                    $Rr = ceil($ref);
                                    $h = intval($Rr % (12 * 3600));
                                    $hour = intval($h / 3600);
                                    $m = intval($h % 3600);
                                    $minutes = intval($m / 60);
                                    $seconds = intval($m % 60);
                                    $time = "07:20:00";
                                    $time2 = $minutes . ":" . $seconds . ":" . "00";
                                    $secs = strtotime($time2) - strtotime("00:00:00");
                                    $result = date("H:i:s", strtotime($time) + $secs);
                                    return $newdattee . " " . $result;

                                } else {
                                    $vv = $date_start . " " . $time_start . '' . ":00";
                                    $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                    $v = Carbon::make($dateTime);
                                    $sum = $orderss->productiontime + $orderss->format_time + $orderss->insert_time + $orderss->color_time;
                                    $number = strtotime($v);
                                    $f = $sum + $number;
                                    $date = date('Y/m/d H:i:s', $f);
                                    $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                    return $y;
                                }
                            } else {
                                $date_startt = $row->date_start;
                                $time_startt = $row->time_start;
                                $vvv = $date_startt . " " . $time_startt . '' . ":00";
                                return $vvv;
                            }


                        }
                    } else {
                        return '';
                    }


                })
                ->addColumn('productiontime', function ($row) {
                    date_default_timezone_set('Asia/Tehran');
                    $orderss = DB::table('production_orders')
                        ->where('device_id', $row->device_id)
                        ->where('order', '<', $row->order)
                        ->latest('order')->first();

                    if ($row->start == null) {
                        $orders = DB::table('production_orders')
                            ->where('device_id', $row->device_id)
                            ->where('order', '<', $row->order)
                            ->whereNotNull('start')
                            ->latest('order')->first();
                        if (!empty($orders)) {
                            $start = $orders->start;
                            $date_start = $orders->date_start;
                            $time_start = $orders->time_start;
                        } else {
                            $start = $row->start;
                            $date_start = $row->date_start;
                            $time_start = $row->time_start;
                        }
                    } else {
                        $start = $row->start;
                        $date_start = $row->date_start;
                        $time_start = $row->time_start;
                    }
                    $order = DB::table('production_orders')
                        ->where('device_id', '=', $row->device_id)
                        ->whereNotNull('order')
                        ->first();
                    if (!empty($order)) {
                        $check = DB::table('production_orders')
                            ->where('order', '<', $row->order)
                            ->where('device_id', '=', $row->device_id)
                            ->latest()
                            ->first();
                        if (!empty($check)) {
                            $time = $check->productiontime;
                        } else {
                            $time = 0;
                        }
                    } else {
                        $time = 0;
                    }

                    if (!empty($date_start)) {

                        if (empty($orderss)) {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }

                            if ($row->productiontime > $seconds) {

                                $ff = $row->productiontime - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        } else {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }
                            $dffsf = $orderss->productiontime + $row->productiontime;
                            if ($dffsf > $seconds) {

                                $ff = $dffsf - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        }


                    } else {
                        return '';
                    }


                })
//                ->addColumn('finaltime', function ($row) {
//
//                    $product = DB::table('production_store')
//                        ->where('id_production', $row->id)
//                        ->sum('hnumber');
//                    $number = $row->number - $product;
//                    if (!empty($row->stime)) {
//                        $namee = Format::where('id', $row->format_id)->first();
//                        $tt = $number / $namee->quetta;
//                        $vv = $tt * $row->stime;
//                        $productiontime = $vv;
//                    } else {
//                        $format = DB::table('model_products')
//                            ->where('product_id', $row->product_id)
//                            ->first();
//                        $name = Format::where('id', $row->format_id)->first();
//                        $t = $number / $name->quetta;
//                        $v = $t * $format->cycletime;
//                        $productiontime = $v;
//                    }
//                    $days = intval(intval($productiontime) / (3600 * 12));
//                    $h = intval($productiontime % (12 * 3600));
//                    $hour = intval($h / 3600);
//                    $m = intval($h % 3600);
//                    $minutes = intval($m / 60);
//                    $seconds = intval($m % 60);
//                    if ($productiontime >= 43200) {
//                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } elseif ($productiontime >= 3600) {
//                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } else {
//                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    }
//                })
                ->addColumn('actions', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('ViewProduction.list');
    }

    public function DevicesList(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('production_orders')
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
                ->addColumn('start', function ($row) {
                    $order = DB::table('production_details')
                        ->where('order_id', $row->id)
                        ->first();
                    if (!empty($order)) {
                        $date = Jalalian::forge($order->start_time)->format('Y/m/d H:i:s');
                        return $date;
                    } else {
                        return "";
                    }

                })
                ->addColumn('status', function ($row) {
                    if ($row->status == null) {
                        return "بدون وضعیت";
                    } elseif ($row->status == 1) {
                        return "در حال تولید";
                    }
                })
//                ->addColumn('finaltime', function ($row) {
//
//                    $product = DB::table('production_store')
//                        ->where('id_production', $row->id)
//                        ->sum('hnumber');
//                    $number = $row->number - $product;
//                    if (!empty($row->stime)) {
//                        $namee = Format::where('id', $row->format_id)->first();
//                        $tt = $number / $namee->quetta;
//                        $vv = $tt * $row->stime;
//                        $productiontime = $vv;
//                    } else {
//                        $format = DB::table('model_products')
//                            ->where('product_id', $row->product_id)
//                            ->first();
//                        $name = Format::where('id', $row->format_id)->first();
//                        $t = $number / $name->quetta;
//                        $v = $t * $format->cycletime;
//                        $productiontime = $v;
//                    }
//                    $days = intval(intval($productiontime) / (3600 * 24));
//                    $h = intval($productiontime % (24 * 3600));
//                    $hour = intval($h / 3600);
//                    $m = intval($h % 3600);
//                    $minutes = intval($m / 60);
//                    $seconds = intval($m % 60);
//                    if ($productiontime >= 86400) {
//                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } elseif ($productiontime >= 3600) {
//                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } else {
//                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    }
//                })
                ->addColumn('startt', function ($row) {
                    date_default_timezone_set('Asia/Tehran');

                    $ste = DB::table('production_orders')
                        ->whereNotNull('start')
                        ->first();

                    if (!empty($ste)) {
                        if (!empty($row->date_start)) {
                            $date_startt = $row->date_start;
                            $time_startt = $row->time_start;
                            $vvv = $date_startt . " " . $time_startt . '' . ":00";
                            return $vvv;
                        } else {
                            $orderss = DB::table('production_orders')
                                ->where('device_id', $row->device_id)
                                ->where('order', '<', $row->order)
                                ->latest('order')->first();
                            if (!empty($orderss)) {
                                $ordersss = DB::table('production_orders')
                                    ->where('device_id', $orderss->device_id)
                                    ->where('order', '<', $orderss->order)
                                    ->latest('order')->first();

                                if (!empty($ordersss)) {
                                    $rr = $ordersss->productiontime;
                                } else {
                                    $rr = null;
                                }


                                $order = DB::table('production_orders')
                                    ->where('device_id', '=', $row->device_id)
                                    ->whereNotNull('order')
                                    ->first();

                                if ($orderss->start == null) {
                                    $orderssa = DB::table('production_orders')
                                        ->where('device_id', $orderss->device_id)
                                        ->where('order', '<', $orderss->order)
                                        ->whereNotNull('start')
                                        ->latest('order')->first();
                                    if (!empty($orderssa)) {
                                        $date_start = $orderssa->date_start;
                                        $time_start = $orderssa->time_start;
                                    } else {
                                        $date_start = $orderss->date_start;
                                        $time_start = $orderss->time_start;
                                    }
                                } else {
                                    $date_start = $orderss->date_start;
                                    $time_start = $orderss->time_start;
                                }


                                if (!empty($orderss->time_start)) {
                                    $date_begin = "1999/01/01" . ' ' . $orderss->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $orderss->time_start;
                                    $ooo = $orderss->date_start;
                                } else {
                                    $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $order->time_start;
                                    $ooo = $order->date_start;
                                }
                                $dffsf = $orderss->productiontime + $rr;
                                if ($dffsf > $seconds) {

                                    $ff = $dffsf - $seconds;
                                    $date = date($ooo);
                                    $newdate = strtotime('+1 day', strtotime($date));
                                    $newdatee = date('Y/m/d', $newdate);
                                    $gg = $ff / 43200;
                                    $ggg = floor($gg);
                                    $datee = date($newdatee);
                                    $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                    $newdattee = date('Y/m/d', $newdatte);
                                    $trtr = $gg - $ggg;
                                    $ref = $trtr * 43200 / 60;
                                    $Rr = ceil($ref);
                                    $h = intval($Rr % (12 * 3600));
                                    $hour = intval($h / 3600);
                                    $m = intval($h % 3600);
                                    $minutes = intval($m / 60);
                                    $seconds = intval($m % 60);
                                    $time = "07:20:00";
                                    $time2 = $minutes . ":" . $seconds . ":" . "00";
                                    $secs = strtotime($time2) - strtotime("00:00:00");
                                    $result = date("H:i:s", strtotime($time) + $secs);
                                    return $newdattee . " " . $result;

                                } else {
                                    $vv = $date_start . " " . $time_start . '' . ":00";
                                    $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                    $v = Carbon::make($dateTime);
                                    $sum = $orderss->productiontime + $orderss->format_time + $orderss->insert_time + $orderss->color_time;
                                    $number = strtotime($v);
                                    $f = $sum + $number;
                                    $date = date('Y/m/d H:i:s', $f);
                                    $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                    return $y;
                                }
                            } else {
                                $date_startt = $row->date_start;
                                $time_startt = $row->time_start;
                                $vvv = $date_startt . " " . $time_startt . '' . ":00";
                                return $vvv;
                            }


                        }
                    } else {
                        return '';
                    }


                })
                ->addColumn('productiontime', function ($row) {
                    date_default_timezone_set('Asia/Tehran');
                    $orderss = DB::table('production_orders')
                        ->where('device_id', $row->device_id)
                        ->where('order', '<', $row->order)
                        ->latest('order')->first();

                    if ($row->start == null) {
                        $orders = DB::table('production_orders')
                            ->where('device_id', $row->device_id)
                            ->where('order', '<', $row->order)
                            ->whereNotNull('start')
                            ->latest('order')->first();
                        if (!empty($orders)) {
                            $start = $orders->start;
                            $date_start = $orders->date_start;
                            $time_start = $orders->time_start;
                        } else {
                            $start = $row->start;
                            $date_start = $row->date_start;
                            $time_start = $row->time_start;
                        }
                    } else {
                        $start = $row->start;
                        $date_start = $row->date_start;
                        $time_start = $row->time_start;
                    }
                    $order = DB::table('production_orders')
                        ->where('device_id', '=', $row->device_id)
                        ->whereNotNull('order')
                        ->first();
                    if (!empty($order)) {
                        $check = DB::table('production_orders')
                            ->where('order', '<', $row->order)
                            ->where('device_id', '=', $row->device_id)
                            ->latest()
                            ->first();
                        if (!empty($check)) {
                            $time = $check->productiontime;
                        } else {
                            $time = 0;
                        }
                    } else {
                        $time = 0;
                    }

                    if (!empty($date_start)) {

                        if (empty($orderss)) {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }

                            if ($row->productiontime > $seconds) {

                                $ff = $row->productiontime - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        } else {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }
                            $dffsf = $orderss->productiontime + $row->productiontime;
                            if ($dffsf > $seconds) {

                                $ff = $dffsf - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        }


                    } else {
                        return '';
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

    public function DevicesListview(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('production_orders')
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
                ->addColumn('start', function ($row) {
                    $order = DB::table('production_details')
                        ->where('order_id', $row->id)
                        ->first();
                    if (!empty($order)) {
                        $date = Jalalian::forge($order->start_time)->format('Y/m/d H:i:s');
                        return $date;
                    } else {
                        return "";
                    }

                })
                ->addColumn('status', function ($row) {
                    if ($row->status == null) {
                        return "بدون وضعیت";
                    } elseif ($row->status == 1) {
                        return "در حال تولید";
                    }
                })
//                ->addColumn('finaltime', function ($row) {
//
//                    $product = DB::table('production_store')
//                        ->where('id_production', $row->id)
//                        ->sum('hnumber');
//                    $number = $row->number - $product;
//                    if (!empty($row->stime)) {
//                        $namee = Format::where('id', $row->format_id)->first();
//                        $tt = $number / $namee->quetta;
//                        $vv = $tt * $row->stime;
//                        $productiontime = $vv;
//                    } else {
//                        $format = DB::table('model_products')
//                            ->where('product_id', $row->product_id)
//                            ->first();
//                        $name = Format::where('id', $row->format_id)->first();
//                        $t = $number / $name->quetta;
//                        $v = $t * $format->cycletime;
//                        $productiontime = $v;
//                    }
//                    $days = intval(intval($productiontime) / (3600 * 24));
//                    $h = intval($productiontime % (24 * 3600));
//                    $hour = intval($h / 3600);
//                    $m = intval($h % 3600);
//                    $minutes = intval($m / 60);
//                    $seconds = intval($m % 60);
//                    if ($productiontime >= 86400) {
//                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } elseif ($productiontime >= 3600) {
//                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    } else {
//                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
//                    }
//                })
                ->addColumn('startt', function ($row) {
                    date_default_timezone_set('Asia/Tehran');

                    $ste = DB::table('production_orders')
                        ->whereNotNull('start')
                        ->first();

                    if (!empty($ste)) {
                        if (!empty($row->date_start)) {
                            $date_startt = $row->date_start;
                            $time_startt = $row->time_start;
                            $vvv = $date_startt . " " . $time_startt . '' . ":00";
                            return $vvv;
                        } else {
                            $orderss = DB::table('production_orders')
                                ->where('device_id', $row->device_id)
                                ->where('order', '<', $row->order)
                                ->latest('order')->first();
                            if (!empty($orderss)) {
                                $ordersss = DB::table('production_orders')
                                    ->where('device_id', $orderss->device_id)
                                    ->where('order', '<', $orderss->order)
                                    ->latest('order')->first();

                                if (!empty($ordersss)) {
                                    $rr = $ordersss->productiontime;
                                } else {
                                    $rr = null;
                                }


                                $order = DB::table('production_orders')
                                    ->where('device_id', '=', $row->device_id)
                                    ->whereNotNull('order')
                                    ->first();

                                if ($orderss->start == null) {
                                    $orderssa = DB::table('production_orders')
                                        ->where('device_id', $orderss->device_id)
                                        ->where('order', '<', $orderss->order)
                                        ->whereNotNull('start')
                                        ->latest('order')->first();
                                    if (!empty($orderssa)) {
                                        $date_start = $orderssa->date_start;
                                        $time_start = $orderssa->time_start;
                                    } else {
                                        $date_start = $orderss->date_start;
                                        $time_start = $orderss->time_start;
                                    }
                                } else {
                                    $date_start = $orderss->date_start;
                                    $time_start = $orderss->time_start;
                                }


                                if (!empty($orderss->time_start)) {
                                    $date_begin = "1999/01/01" . ' ' . $orderss->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $orderss->time_start;
                                    $ooo = $orderss->date_start;
                                } else {
                                    $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                    $date_end = "1999/01/01" . ' ' . "19:20:00";
                                    $start = Carbon::parse($date_begin);
                                    $end = Carbon::parse($date_end);
                                    $seconds = $end->diffInSeconds($start);
                                    $oo = $order->time_start;
                                    $ooo = $order->date_start;
                                }
                                $dffsf = $orderss->productiontime + $rr;
                                if ($dffsf > $seconds) {

                                    $ff = $dffsf - $seconds;
                                    $date = date($ooo);
                                    $newdate = strtotime('+1 day', strtotime($date));
                                    $newdatee = date('Y/m/d', $newdate);
                                    $gg = $ff / 43200;
                                    $ggg = floor($gg);
                                    $datee = date($newdatee);
                                    $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                    $newdattee = date('Y/m/d', $newdatte);
                                    $trtr = $gg - $ggg;
                                    $ref = $trtr * 43200 / 60;
                                    $Rr = ceil($ref);
                                    $h = intval($Rr % (12 * 3600));
                                    $hour = intval($h / 3600);
                                    $m = intval($h % 3600);
                                    $minutes = intval($m / 60);
                                    $seconds = intval($m % 60);
                                    $time = "07:20:00";
                                    $time2 = $minutes . ":" . $seconds . ":" . "00";
                                    $secs = strtotime($time2) - strtotime("00:00:00");
                                    $result = date("H:i:s", strtotime($time) + $secs);
                                    return $newdattee . " " . $result;

                                } else {
                                    $vv = $date_start . " " . $time_start . '' . ":00";
                                    $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                    $v = Carbon::make($dateTime);
                                    $sum = $orderss->productiontime + $orderss->format_time + $orderss->insert_time + $orderss->color_time;
                                    $number = strtotime($v);
                                    $f = $sum + $number;
                                    $date = date('Y/m/d H:i:s', $f);
                                    $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                    return $y;
                                }
                            } else {
                                $date_startt = $row->date_start;
                                $time_startt = $row->time_start;
                                $vvv = $date_startt . " " . $time_startt . '' . ":00";
                                return $vvv;
                            }


                        }
                    } else {
                        return '';
                    }


                })
                ->addColumn('productiontime', function ($row) {
                    date_default_timezone_set('Asia/Tehran');
                    $orderss = DB::table('production_orders')
                        ->where('device_id', $row->device_id)
                        ->where('order', '<', $row->order)
                        ->latest('order')->first();

                    if ($row->start == null) {
                        $orders = DB::table('production_orders')
                            ->where('device_id', $row->device_id)
                            ->where('order', '<', $row->order)
                            ->whereNotNull('start')
                            ->latest('order')->first();
                        if (!empty($orders)) {
                            $start = $orders->start;
                            $date_start = $orders->date_start;
                            $time_start = $orders->time_start;
                        } else {
                            $start = $row->start;
                            $date_start = $row->date_start;
                            $time_start = $row->time_start;
                        }
                    } else {
                        $start = $row->start;
                        $date_start = $row->date_start;
                        $time_start = $row->time_start;
                    }
                    $order = DB::table('production_orders')
                        ->where('device_id', '=', $row->device_id)
                        ->whereNotNull('order')
                        ->first();
                    if (!empty($order)) {
                        $check = DB::table('production_orders')
                            ->where('order', '<', $row->order)
                            ->where('device_id', '=', $row->device_id)
                            ->latest()
                            ->first();
                        if (!empty($check)) {
                            $time = $check->productiontime;
                        } else {
                            $time = 0;
                        }
                    } else {
                        $time = 0;
                    }

                    if (!empty($date_start)) {

                        if (empty($orderss)) {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }

                            if ($row->productiontime > $seconds) {

                                $ff = $row->productiontime - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        } else {

                            if (!empty($row->time_start)) {
                                $date_begin = "1999/01/01" . ' ' . $row->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $row->time_start;
                                $ooo = $row->date_start;
                            } else {
                                $date_begin = "1999/01/01" . ' ' . $order->time_start . ':' . "00";
                                $date_end = "1999/01/01" . ' ' . "19:20:00";
                                $start = Carbon::parse($date_begin);
                                $end = Carbon::parse($date_end);
                                $seconds = $end->diffInSeconds($start);
                                $oo = $order->time_start;
                                $ooo = $order->date_start;
                            }
                            $dffsf = $orderss->productiontime + $row->productiontime;
                            if ($dffsf > $seconds) {

                                $ff = $dffsf - $seconds;
                                $date = date($ooo);
                                $newdate = strtotime('+1 day', strtotime($date));
                                $newdatee = date('Y/m/d', $newdate);
                                $gg = $ff / 43200;
                                $ggg = floor($gg);
                                $datee = date($newdatee);
                                $newdatte = strtotime('' . $ggg . ' day', strtotime($datee));
                                $newdattee = date('Y/m/d', $newdatte);
                                $trtr = $gg - $ggg;
                                $ref = $trtr * 43200 / 60;
                                $Rr = ceil($ref);
                                $h = intval($Rr % (12 * 3600));
                                $hour = intval($h / 3600);
                                $m = intval($h % 3600);
                                $minutes = intval($m / 60);
                                $seconds = intval($m % 60);
                                $time = "07:20:00";
                                $time2 = $minutes . ":" . $seconds . ":" . "00";
                                $secs = strtotime($time2) - strtotime("00:00:00");
                                $result = date("H:i:s", strtotime($time) + $secs);
                                return $newdattee . " " . $result;

                            } else {
                                $vv = $date_start . " " . $time_start . '' . ":00";
                                $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $vv);
                                $v = Carbon::make($dateTime);
                                $sum = $row->productiontime + $row->format_time + $row->insert_time + $row->color_time;
                                $number = strtotime($v);
                                $f = $sum + $number;
                                $date = date('Y/m/d H:i:s', $f);
                                $y = Jalalian::forge($date)->format('Y/m/d H:i:s');
                                return $y;
                            }
                        }


                    } else {
                        return '';
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

    public function check(Request $request)
    {
        $model = DB::table('model_products')
            ->where('product_id', $request->product)
            ->first();
        return response()->json($model);
    }

    public function deviceedit(Request $request)
    {
        $date = DB::table('production_orders')
            ->where('id', $request->id)
            ->first();
        return response()->json($date);


    }

    public function start($id)
    {
        $date = Carbon::now('Asia/Tehran');

        $devices = DB::table('production_orders')
            ->where('id', $id)
            ->first();

        DB::table('production_orders')
            ->where('id', $id)
            ->update([
                'status' => 1,
            ]);

        DB::table('production_details')
            ->insert([
                'order_id' => $id,
                'start_time' => $date,
            ]);

        DB::table('devices')
            ->where('id', $devices->device_id)
            ->update([
                'status' => 1,
            ]);


        return response()->json(['success' => 'success']);

    }

    public function date(Request $request)
    {
        date_default_timezone_set('Asia/Tehran');
        $time1 = $request->created . ' ' . $request->time_date;
        $time2 = Jalalian::now()->format('Y/m/d H:i');
        $v1 = verta();
        $v2 = verta($time1);
        $v3 = verta($time2);
        $time = $v3->diffSeconds($v2);

        DB::table('production_orders')
            ->where('id', $request->id_date)
            ->update([
                'date_start' => $request->created,
                'time_start' => $request->time_date,
                'start' => $time,
            ]);

        return response()->json(['success' => 'success']);

    }

    public function store(Request $request)
    {


        $format = DB::table('model_products')
            ->where('product_id', $request->p)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $t = $request->number / $name->quetta;
        $v = $t * $format->cycletime;
        $date = Carbon::now();
        ProductionOrder::create([
            'product_id' => $request->p,
            'color_id' => $request->c,
            'bach_id' => $request->bach_id,
            'device_id' => $request->device_id,
            'format_id' => $request->format_id,
            'insert_id' => $request->insert_id,
            'number' => $request->number,
            'productiontime' => $v,
            'color_time' => $request->color_time * 60,
            'format_time' => $request->format_time * 60,
            'insert_time' => $request->insert_time * 60,
            'stime' => $request->stime,
            'created' => Jalalian::forge($date)->format('Y/m/d'),
            'created_at' => $date,
        ]);
        $id = DB::table('production_orders')
            ->where('device_id', $request->device_id)
            ->latest('id')->first();
        ProductionOrder::where('id', $id->id)
            ->update([
                'order' => $id->id,
            ]);
        return response()->json(['success' => 'success']);

    }

    public function storeedit(Request $request)
    {

        $id = DB::table('production_orders')
            ->where('device_id', $request->device_idd)
            ->latest('id')->first();
        if (!empty($id)) {
            $i = $id->id;
        } else {
            $i = 1;
        }
        DB::table('production_orders')
            ->where('id', $request->edit_id)
            ->update([
                'order' => $i,
                'device_id' => $request->device_idd,
            ]);

        return response()->json(['success' => 'success']);

    }

    public function checkdate(Request $request)
    {
        $production_orders = DB::table('production_orders')
            ->where('id', $request->id)
            ->first();
        return response()->json($production_orders);

    }

    public function sort(Request $request)
    {


        foreach ($request->input('rows', []) as $row) {
            $data = ProductionOrder::find($row['id'])->update([
                'order' => $row['position']
            ]);
        }

        return response()->json($data);


    }

    public function print($id)
    {

        $production_orders = DB::table('production_orders')
            ->where('id', $id)
            ->first();
        $products = DB::table('products')
            ->where('id', $production_orders->product_id)
            ->first();
        $color = DB::table('colors')
            ->where('id', $production_orders->color_id)
            ->first();


        $model_products = DB::table('model_products')
            ->where('product_id', $production_orders->product_id)
            ->where('format_id', $production_orders->format_id)
            ->first();
        $production_information = DB::table('production_information')
            ->where('id', $production_orders->bach_id)
            ->first();


        $colors = DB::table('colors')
            ->where('id', $production_information->mastarbach)
            ->first();

        $product = DB::table('production_store')
            ->where('id_production', $production_orders->id)
            ->sum('hnumber');

        $devices = DB::table('devices')
            ->where('id', $production_orders->device_id)
            ->first();


        $detail_production_information = DB::table('detail_production_information')
            ->where('information_id', $production_information->id)
            ->get();

        $qc_productio = DB::table('qc_production')
            ->where('id_production', $id)
            ->first();

        if (!empty($qc_productio)) {
            $qc_production = $qc_productio;
            $user = DB::table('users')
                ->where('id', $qc_productio->user_id)
                ->first();
        } else {
            $qc_production = null;
            $user = null;
        }


        $polymerics = DB::table('polymerics')->get();

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
        $days = intval(intval($productiontime) / (3600 * 12));
        $h = intval($productiontime % (12 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);

        if ($productiontime >= 43200) {
            $ss = $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
        } elseif ($productiontime >= 3600) {
            $ss = $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
        } else {
            $ss = $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
        }


        return view('ViewProduction.print', compact('id', 'products', 'color',
            'production_orders', 'model_products', 'production_information', 'ss', 'namee', 'devices'
            , 'colors', 'detail_production_information', 'polymerics', 'qc_production', 'user'));

    }

    public function printt($id)
    {

        $production_orders = DB::table('production_orders')
            ->where('id', $id)
            ->first();
        $products = DB::table('products')
            ->where('id', $production_orders->product_id)
            ->first();
        $color = DB::table('colors')
            ->where('id', $production_orders->color_id)
            ->first();


        $model_products = DB::table('model_products')
            ->where('product_id', $production_orders->product_id)
            ->where('format_id', $production_orders->format_id)
            ->first();
        $production_information = DB::table('production_information')
            ->where('id', $production_orders->bach_id)
            ->first();


        $colors = DB::table('colors')
            ->where('id', $production_information->mastarbach)
            ->first();

        $product = DB::table('production_store')
            ->where('id_production', $production_orders->id)
            ->sum('hnumber');

        $devices = DB::table('devices')
            ->where('id', $production_orders->device_id)
            ->first();

        $qc_productio = DB::table('qc_production')
            ->where('id_production', $id)
            ->first();

        if (!empty($qc_productio)) {
            $qc_production = $qc_productio;
            $user = DB::table('users')
                ->where('id', $qc_productio->user_id)
                ->first();
        } else {
            $qc_production = null;
            $user = null;
        }

        $detail_production_information = DB::table('detail_production_information')
            ->where('information_id', $production_information->id)
            ->get();

        $polymerics = DB::table('polymerics')->get();

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
        $days = intval(intval($productiontime) / (3600 * 12));
        $h = intval($productiontime % (12 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);

        if ($productiontime >= 43200) {
            $ss = $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
        } elseif ($productiontime >= 3600) {
            $ss = $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
        } else {
            $ss = $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
        }


        return view('ViewProduction.printt', compact('id', 'products', 'color',
            'production_orders', 'model_products', 'production_information', 'ss', 'namee', 'devices'
            , 'colors', 'detail_production_information', 'polymerics', 'qc_production', 'user'));

    }

    public function CheckSuccess($id)
    {
        return response()->json($id);

    }

    public function storesuccess(Request $request)
    {
        $date = Jalalian::now()->format('Y/m/d');
        DB::table('qc_production')
            ->insert([
                'id_production' => $request->id_invoice,
                'user_id' => auth()->user()->id,
                'status' => $request->status,
                'description' => $request->description,
                'date' => $date,
            ]);
        return response()->json(['success' => 'success']);
    }

    public function stedit(Request $request)
    {
        $trtr = DB::table('production_orders')
            ->where('id', $request->i)
            ->first();


        $format = DB::table('model_products')
            ->where('product_id', $trtr->product_id)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $t = $request->number / $name->quetta;
        $v = $t * $format->cycletime;

        DB::table('production_orders')
            ->where('id', $request->i)
            ->update([
                'bach_id' => $request->bach_iid,
                'device_id' => $request->device_idds,
                'format_id' => $request->format_iid,
                'insert_id' => $request->insert_iid,
                'number' => $request->numbeerr,
                'productiontime' => $v,
                'color_time' => $request->color_timee * 60,
                'format_time' => $request->format_timee * 60,
                'insert_time' => $request->insert_timee * 60,
                'stime' => $request->stimee,
            ]);

        return response()->json(['success' => 'success']);
    }

    public function sortt(Request $request)
    {


        foreach ($request->input('rows', []) as $row) {
            $data = ProductionOrder::find($row['id'])->update([
                'order' => $row['position']
            ]);
        }

        return response()->json($data);


    }

    public function getcharacteristic(Request $request)
    {


        if ($request->insert == 0) {
            $insert = null;
        } else {
            $insert = $request->insert;
        }
        $data = DB::table('model_products')
            ->where('format_id', $request->formatt)
            ->where('insert_id', $insert)
            ->where('product_id', $request->product)
            ->first();
        $informations = DB::table('detail_production_information')
            ->where('information_id', $request->device_id)
            ->get();
        $production_information = DB::table('production_information')
            ->where('id', $request->device_id)
            ->first();
        $barn_mas = DB::table('colors')
            ->where('id', $production_information->mastarbach)
            ->first();

        $check = DB::table('production_orders')
            ->latest('order')
            ->first();
        if (!empty($check)) {
            if ($check->color_id != $request->color) {
                $color_scraps = DB::table('color_scraps')
                    ->where('format_id', $request->formatt)
                    ->where('ofColor_id', $check->color_id)
                    ->where('toColor_id', $request->color)
                    ->first();
                if (!empty($color_scraps)) {
                    $color = $color_scraps->usable + $color_scraps->unusable;
                } else {
                    $color = 0;
                }
            } else {
                $color = 0;
            }
        } else {
            $color = 0;
        }
        if (!empty($barn_mas)) {
            $barn_colors = DB::table('barn_colors')
                ->where('color_id', $barn_mas->color)
                ->first();
            if (!empty($barn_colors)) {
                $sum_barn_mas = $barn_colors->PhysicalInventory + $barn_colors->PhysicalInventor;
            } else {
                $sum_barn_mas = 0;
            }
        } else {
            $sum_barn_mas = 0;
        }
        $production_orders = DB::table('production_orders')
            ->where('product_id', $request->product)
            ->where('color_id', $request->color)
            ->where('bach_id', $request->device_id)
            ->sum('number');
        if ($production_orders != 0) {
            $sumsa = $production_orders * $data->size / 1000;
            $finasa = $sumsa * $production_information->Percentmasterbatch / 100;
            $rere = $sum_barn_mas - $finasa;
        } else {
            $rere = $sum_barn_mas;
        }
        $sumssa = $request->number * $data->size + $color;
        $sum = $sumssa / 1000;
        $fina = $sum * $production_information->Percentmasterbatch / 100;
        $rr = $fina - $rere;
        $rrr = number_format($rr, 2);
        if ($rere >= $fina) {
            $check_mas = null;
        } else {
            $check_mas = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrr . ' ' . 'کیلوگرم' . ' ' . 'از مستربچ' . ' ' . $barn_mas->manufacturer . ' ' . $barn_mas->masterbatch . ' ' . 'کم میباشد';
        }


        $count = count($informations);

        if ($count == 1) {
            for ($i = 0; $i <= $count; $i++) {
                $matrial = DB::table('polymerics')
                    ->where('id', $informations[0]->materials)
                    ->first();
                $name_matrial = $matrial->grid;
                $darsad = $sum * $informations[0]->materials / 100;
                $barn_mat = DB::table('barn_materials')
                    ->where('id', $matrial->id)
                    ->first();
                if (!empty($barn_mat)) {
                    $sum_barn_mat = $barn_mat->PhysicalInventory + $barn_mat->PhysicalInventor;
                } else {
                    $sum_barn_mat = 0;
                }
                $rre = $darsad - $sum_barn_mat;
                $rrre = number_format($rre, 2);

                if ($sum_barn_mat >= $rre) {
                    $check_mat = null;
                } else {
                    $check_mat = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial . ' ' . 'کم میباشد';
                }
                $check_mat1 = null;
                $check_mat2 = null;
                $check_mat3 = null;
                $check_mat4 = null;
            }

        } else if ($count == 2) {

            $matrial = DB::table('polymerics')
                ->where('id', $informations[0]->materials)
                ->first();
            $name_matrial = $matrial->grid;
            $darsad = $sum * $informations[0]->materials / 100;
            $barn_mat = DB::table('barn_materials')
                ->where('id', $matrial->id)
                ->first();
            if (!empty($barn_mat)) {
                $sum_barn_mat = $barn_mat->PhysicalInventory + $barn_mat->PhysicalInventor;
            } else {
                $sum_barn_mat = 0;
            }
            $rre = $darsad - $sum_barn_mat;
            $rrre = number_format($rre, 2);

            if ($sum_barn_mat >= $rre) {
                $check_mat = null;
            } else {
                $check_mat = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial . ' ' . 'کم میباشد';
            }


            $matrial1 = DB::table('polymerics')
                ->where('id', $informations[1]->materials)
                ->first();
            $name_matrial1 = $matrial1->grid;
            $darsad1 = $sum * $informations[1]->materials / 100;
            $barn_mat1 = DB::table('barn_materials')
                ->where('id', $matrial1->id)
                ->first();
            if (!empty($barn_mat1)) {
                $sum_barn_mat1 = $barn_mat1->PhysicalInventory + $barn_mat1->PhysicalInventor;
            } else {
                $sum_barn_mat1 = 0;
            }
            $rre1 = $darsad1 - $sum_barn_mat1;
            $rrre1 = number_format($rre1, 2);

            if ($sum_barn_mat1 >= $rre1) {
                $check_mat1 = null;
            } else {
                $check_mat1 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre1 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial1 . ' ' . 'کم میباشد';

            }
            $check_mat2 = null;
            $check_mat3 = null;
            $check_mat4 = null;
        } else if ($count == 3) {
            $matrial = DB::table('polymerics')
                ->where('id', $informations[0]->materials)
                ->first();
            $name_matrial = $matrial->grid;
            $darsad = $sum * $informations[0]->materials / 100;
            $barn_mat = DB::table('barn_materials')
                ->where('id', $matrial->id)
                ->first();
            if (!empty($barn_mat)) {
                $sum_barn_mat = $barn_mat->PhysicalInventory + $barn_mat->PhysicalInventor;
            } else {
                $sum_barn_mat = 0;
            }
            $rre = $darsad - $sum_barn_mat;
            $rrre = number_format($rre, 2);
            if ($sum_barn_mat >= $rre) {
                $check_mat = null;
            } else {
                $check_mat = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial . ' ' . 'کم میباشد';
            }
            $matrial1 = DB::table('polymerics')
                ->where('id', $informations[1]->materials)
                ->first();
            $name_matrial1 = $matrial1->grid;
            $darsad1 = $sum * $informations[1]->materials / 100;
            $barn_mat1 = DB::table('barn_materials')
                ->where('id', $matrial1->id)
                ->first();
            if (!empty($barn_mat1)) {
                $sum_barn_mat1 = $barn_mat1->PhysicalInventory + $barn_mat1->PhysicalInventor;
            } else {
                $sum_barn_mat1 = 0;
            }
            $rre1 = $darsad1 - $sum_barn_mat1;
            $rrre1 = number_format($rre1, 2);
            if ($sum_barn_mat1 >= $rre1) {
                $check_mat1 = null;
            } else {
                $check_mat1 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre1 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial1 . ' ' . 'کم میباشد';
            }
            $matrial2 = DB::table('polymerics')
                ->where('id', $informations[2]->materials)
                ->first();
            $name_matrial2 = $matrial2->grid;
            $darsad2 = $sum * $informations[2]->materials / 100;
            $barn_mat2 = DB::table('barn_materials')
                ->where('id', $matrial2->id)
                ->first();
            if (!empty($barn_mat2)) {
                $sum_barn_mat2 = $barn_mat2->PhysicalInventory + $barn_mat2->PhysicalInventor;
            } else {
                $sum_barn_mat2 = 0;
            }
            $rre2 = $darsad2 - $sum_barn_mat2;
            $rrre2 = number_format($rre2, 2);
            if ($sum_barn_mat2 >= $rre2) {
                $check_mat2 = null;
            } else {
                $check_mat2 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre2 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial2 . ' ' . 'کم میباشد';
            }
            $check_mat3 = null;
            $check_mat4 = null;
        } else if ($count == 4) {
            $matrial = DB::table('polymerics')
                ->where('id', $informations[0]->materials)
                ->first();
            $name_matrial = $matrial->grid;
            $darsad = $sum * $informations[0]->materials / 100;
            $barn_mat = DB::table('barn_materials')
                ->where('id', $matrial->id)
                ->first();
            if (!empty($barn_mat)) {
                $sum_barn_mat = $barn_mat->PhysicalInventory + $barn_mat->PhysicalInventor;
            } else {
                $sum_barn_mat = 0;
            }
            $rre = $darsad - $sum_barn_mat;
            $rrre = number_format($rre, 2);
            if ($sum_barn_mat >= $rre) {
                $check_mat = null;
            } else {
                $check_mat = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial . ' ' . 'کم میباشد';
            }
            $matrial1 = DB::table('polymerics')
                ->where('id', $informations[1]->materials)
                ->first();
            $name_matrial1 = $matrial1->grid;
            $darsad1 = $sum * $informations[1]->materials / 100;
            $barn_mat1 = DB::table('barn_materials')
                ->where('id', $matrial1->id)
                ->first();
            if (!empty($barn_mat1)) {
                $sum_barn_mat1 = $barn_mat1->PhysicalInventory + $barn_mat1->PhysicalInventor;
            } else {
                $sum_barn_mat1 = 0;
            }
            $rre1 = $darsad1 - $sum_barn_mat1;
            $rrre1 = number_format($rre1, 2);
            if ($sum_barn_mat1 >= $rre1) {
                $check_mat1 = null;
            } else {
                $check_mat1 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre1 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial1 . ' ' . 'کم میباشد';
            }
            $matrial2 = DB::table('polymerics')
                ->where('id', $informations[2]->materials)
                ->first();
            $name_matrial2 = $matrial2->grid;
            $darsad2 = $sum * $informations[2]->materials / 100;
            $barn_mat2 = DB::table('barn_materials')
                ->where('id', $matrial2->id)
                ->first();
            if (!empty($barn_mat2)) {
                $sum_barn_mat2 = $barn_mat2->PhysicalInventory + $barn_mat2->PhysicalInventor;
            } else {
                $sum_barn_mat2 = 0;
            }
            $rre2 = $darsad2 - $sum_barn_mat2;
            $rrre2 = number_format($rre2, 2);
            if ($sum_barn_mat2 >= $rre2) {
                $check_mat2 = null;
            } else {
                $check_mat2 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre2 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial2 . ' ' . 'کم میباشد';
            }
            $matrial3 = DB::table('polymerics')
                ->where('id', $informations[3]->materials)
                ->first();
            $name_matrial3 = $matrial3->grid;
            $darsad3 = $sum * $informations[3]->materials / 100;
            $barn_mat3 = DB::table('barn_materials')
                ->where('id', $matrial3->id)
                ->first();
            if (!empty($barn_mat3)) {
                $sum_barn_mat3 = $barn_mat3->PhysicalInventory + $barn_mat3->PhysicalInventor;
            } else {
                $sum_barn_mat3 = 0;
            }
            $rre3 = $darsad3 - $sum_barn_mat3;
            $rrre3 = number_format($rre3, 2);
            if ($sum_barn_mat3 >= $rre3) {
                $check_mat3 = null;
            } else {
                $check_mat3 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre3 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial3 . ' ' . 'کم میباشد';

            }
            $check_mat4 = null;

        } else if ($count == 5) {
            $matrial = DB::table('polymerics')
                ->where('id', $informations[0]->materials)
                ->first();
            $name_matrial = $matrial->grid;
            $darsad = $sum * $informations[0]->materials / 100;
            $barn_mat = DB::table('barn_materials')
                ->where('id', $matrial->id)
                ->first();
            if (!empty($barn_mat)) {
                $sum_barn_mat = $barn_mat->PhysicalInventory + $barn_mat->PhysicalInventor;
            } else {
                $sum_barn_mat = 0;
            }
            $rre = $darsad - $sum_barn_mat;
            $rrre = number_format($rre, 2);
            if ($sum_barn_mat >= $rre) {
                $check_mat = null;
            } else {
                $check_mat = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial . ' ' . 'کم میباشد';
            }
            $matrial1 = DB::table('polymerics')
                ->where('id', $informations[1]->materials)
                ->first();
            $name_matrial1 = $matrial1->grid;
            $darsad1 = $sum * $informations[1]->materials / 100;
            $barn_mat1 = DB::table('barn_materials')
                ->where('id', $matrial1->id)
                ->first();
            if (!empty($barn_mat1)) {
                $sum_barn_mat1 = $barn_mat1->PhysicalInventory + $barn_mat1->PhysicalInventor;
            } else {
                $sum_barn_mat1 = 0;
            }
            $rre1 = $darsad1 - $sum_barn_mat1;
            $rrre1 = number_format($rre1, 2);
            if ($sum_barn_mat1 >= $rre1) {
                $check_mat1 = null;
            } else {
                $check_mat1 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre1 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial1 . ' ' . 'کم میباشد';
            }
            $matrial2 = DB::table('polymerics')
                ->where('id', $informations[2]->materials)
                ->first();
            $name_matrial2 = $matrial2->grid;
            $darsad2 = $sum * $informations[2]->materials / 100;
            $barn_mat2 = DB::table('barn_materials')
                ->where('id', $matrial2->id)
                ->first();
            if (!empty($barn_mat2)) {
                $sum_barn_mat2 = $barn_mat2->PhysicalInventory + $barn_mat2->PhysicalInventor;
            } else {
                $sum_barn_mat2 = 0;
            }
            $rre2 = $darsad2 - $sum_barn_mat2;
            $rrre2 = number_format($rre2, 2);
            if ($sum_barn_mat2 >= $rre2) {
                $check_mat2 = null;
            } else {
                $check_mat2 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre2 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial2 . ' ' . 'کم میباشد';
            }
            $matrial3 = DB::table('polymerics')
                ->where('id', $informations[3]->materials)
                ->first();
            $name_matrial3 = $matrial3->grid;
            $darsad3 = $sum * $informations[3]->materials / 100;
            $barn_mat3 = DB::table('barn_materials')
                ->where('id', $matrial3->id)
                ->first();
            if (!empty($barn_mat3)) {
                $sum_barn_mat3 = $barn_mat3->PhysicalInventory + $barn_mat3->PhysicalInventor;
            } else {
                $sum_barn_mat3 = 0;
            }
            $rre3 = $darsad3 - $sum_barn_mat3;
            $rrre3 = number_format($rre3, 2);
            if ($sum_barn_mat3 >= $rre3) {
                $check_mat3 = null;
            } else {
                $check_mat3 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre3 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial3 . ' ' . 'کم میباشد';
            }
            $matrial4 = DB::table('polymerics')
                ->where('id', $informations[4]->materials)
                ->first();
            $name_matrial4 = $matrial4->grid;
            $darsad4 = $sum * $informations[4]->materials / 100;
            $barn_mat4 = DB::table('barn_materials')
                ->where('id', $matrial4->id)
                ->first();
            if (!empty($barn_mat4)) {
                $sum_barn_mat4 = $barn_mat4->PhysicalInventory + $barn_mat4->PhysicalInventor;
            } else {
                $sum_barn_mat4 = 0;
            }
            $rre4 = $darsad4 - $sum_barn_mat4;
            $rrre4 = number_format($rre4, 2);
            if ($sum_barn_mat4 >= $rre4) {
                $check_mat4 = null;
            } else {
                $check_mat4 = 'برای تولید این مقدار از محصول با مواد تولیدی انتخابی مقدار' . $rrre4 . ' ' . 'کیلوگرم' . ' ' . 'از مواد پلیمیری' . ' ' . $name_matrial4 . ' ' . 'کم میباشد';

            }
        } else {
            $check_mat = null;
            $check_mat1 = null;
            $check_mat2 = null;
            $check_mat3 = null;
            $check_mat4 = null;
        }
        return response()->json(['check_mas' => $check_mas, 'check_mat' => $check_mat
            , 'check_mat1' => $check_mat1, 'check_mat2' => $check_mat2,
            'check_mat3' => $check_mat3, 'check_mat4' => $check_mat4]);
    }

    public function action($row)
    {
        $btn = null;

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-prod-id="' . $row->color_id . '" data-original-title="برنامه جدید"
                       class="new_product">
                       <i class="fa fa-plus fa-lg" title="برنامه جدید"></i>
                       </a>&nbsp;&nbsp;';


//        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
//                      data-id="' . $row->id . '" data-prod-id="' . $row->color_id . '"
//                      data-product-id="' . $row->product_id . '"
//                      data-original-title="نمایش برنامه های تولید"
//                       class="view_Product">
//                       <i class="fa fa-eye fa-lg" title="نمایش برنامه های تولید"></i>
//                       </a>&nbsp;&nbsp;';

        return $btn;


    }

    public function actions($row)
    {
        $btn = null;

//        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
//                      data-id="' . $row->id . '" data-original-title="انتقال به ماشین دیگر"
//                       class="product_change">
//                       <i class="fa fa-exchange fa-lg" title="انتقال به ماشین دیگر"></i>
//                       </a>&nbsp;&nbsp;';

        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="product_delete">
                       <i class="fa fa-trash fa-lg" title="انصراف از تولید"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="نمایش برنامه های تولید"
                       class="checkProcduct">
                       <i class="fa fa-window-close fa-lg" title="انصراف از ادامه تولید"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="تاریخ شروع"
                       class="date_product">
                       <i class="fa fa-calendar fa-lg" title="تاریخ شروع"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش برنامه"
                       class="product_edit">
                       <i class="fa fa-edit fa-lg" title="ویرایش برنامه"></i>
                       </a>&nbsp;&nbsp;';


        $btn = $btn . '<a href="' . route('admin.viewproduct.print', $row->id) . '" target="_blank">
                       <i class="fa fa-eye fa-lg" title="چاپ جزییات برنامه تولید"></i>
                       </a>&nbsp;&nbsp;';


        return $btn;
    }

    function timeDiff($time2, $time1)
    {
        $diff = strtotime($time2) - strtotime($time1);
        if ($diff < 60) {
            return $diff . ' ثانیه قبل';
        } elseif ($diff < 3600) {
            return round($diff / 60, 0, 1) . ' دقیقه قبل';
        } elseif ($diff >= 3660 && $diff < 86400) {
            return round($diff / 3600, 0, 1) . ' ساعت قبل';
        } elseif ($diff > 86400) {
            return round($diff / 86400, 0, 1) . ' روز قبل';
        }
    }


}
