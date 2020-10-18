<?php

namespace App\Http\Controllers\Manufacturing;

use App\Color;
use App\Device;
use App\DeviceOrders;
use App\Format;
use App\Http\Controllers\Controller;
use App\Insert;
use App\Manufacturing;
use App\PMMachine;
use App\Product;
use App\ProductionOrder;
use App\StopDevice;
use App\User;
use Carbon\Carbon;
use DB;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\DataTables;

class ManufacturingController extends Controller
{

    public function list()
    {
        $formats = Format::all();
        $inserts = Insert::all();
        $dt = Carbon::now()->timezone('Asia/Tehran');
        $time = Jalalian::forge($dt)->format('H:i');
        $date = Jalalian::forge(date('Y/m/d'))->format('Y/m/d');

        $full_time_stop = StopDevice::where('device_id', 1)
            ->where('datenow', $date)
            ->sum('minutes');


        $this->device1($date, $time);
        $this->device2($date, $time);
        $this->device3($date, $time);
        $this->device4($date, $time);
        $this->device5($date, $time);
        $this->device6($date, $time);
        $this->device7($date, $time);
        $this->device8($date, $time);
        $this->device9($date, $time);
        $this->device10($date, $time);

        $pm_device1 = PMMachine::where('device_id', 1)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device1 = Device::where('id', 1)->first();


        $pm_device2 = PMMachine::where('device_id', 2)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device2 = Device::where('id', 2)->first();

        $pm_device3 = PMMachine::where('device_id', 3)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device3 = Device::where('id', 3)->first();


        $pm_device4 = PMMachine::where('device_id', 4)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device4 = Device::where('id', 4)->first();

        $pm_device5 = PMMachine::where('device_id', 5)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device5 = Device::where('id', 5)->first();

        $pm_device6 = PMMachine::where('device_id', 6)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device6 = Device::where('id', 6)->first();

        $pm_device7 = PMMachine::where('device_id', 7)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device7 = Device::where('id', 7)->first();

        $pm_device8 = PMMachine::where('device_id', 8)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device8 = Device::where('id', 8)->first();

        $pm_device9 = PMMachine::where('device_id', 9)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();

        $Name_Device9 = Device::where('id', 9)->first();

        $pm_device10 = PMMachine::where('device_id', 10)
            ->whereNull('status')
            ->where('date', '<=', $date)
            ->first();
        $Name_Device10 = Device::where('id', 10)->first();


        if (!empty($Name_Device1)) {
            if (empty($pm_device1)) {
                $Status_Device1 = 'true';
            } else {
                if (!empty($pm_device1)) {
                    if ($date >= $pm_device1->date and $date <= $pm_device1->todate
                        and $time >= $pm_device1->time) {
                        $Status_Device1 = 'false';
                    } else {
                        $Status_Device1 = 'true';
                    }
                } else {
                    $Status_Device1 = 'true';
                }
            }
        } else {
            $Name_Device1 = null;
            $Status_Device1 = null;

        }

        if (!empty($Name_Device2)) {
            if (empty($pm_device2)) {
                $Status_Device2 = 'true';
            } else {
                if (!empty($pm_device2)) {
                    if ($date >= $pm_device2->date and $date <= $pm_device2->todate
                        and $time >= $pm_device2->time) {
                        $Status_Device2 = 'false';
                    } else {
                        $Status_Device2 = 'true';
                    }
                } else {
                    $Status_Device2 = 'true';
                }
            }
        } else {
            $Name_Device2 = null;
            $Status_Device2 = null;
        }

        if (!empty($Name_Device3)) {
            if (empty($pm_device3)) {
                $Status_Device3 = 'true';
            } else {
                if (!empty($pm_device3)) {
                    if ($date >= $pm_device3->date and $date <= $pm_device3->todate
                        and $time >= $pm_device3->time) {
                        $Status_Device3 = 'false';
                    } else {
                        $Status_Device3 = 'true';
                    }
                } else {
                    $Status_Device3 = 'true';
                }
            }
        } else {
            $Name_Device3 = null;
            $Status_Device3 = null;
        }

        if (!empty($Name_Device4)) {
            if (empty($pm_device4)) {
                $Status_Device4 = 'true';
            } else {
                if (!empty($pm_device4)) {
                    if ($date >= $pm_device4->date and $date <= $pm_device4->todate
                        and $time >= $pm_device4->time) {
                        $Status_Device4 = 'false';
                    } else {
                        $Status_Device4 = 'true';
                    }
                } else {
                    $Status_Device4 = 'true';
                }
            }
        } else {
            $Status_Device4 = null;
            $Name_Device4 = null;
        }

        if (!empty($Name_Device5)) {
            if (empty($pm_device5)) {
                $Status_Device5 = 'true';
            } else {
                if (!empty($pm_device5)) {
                    if ($date >= $pm_device5->date and $date <= $pm_device5->todate
                        and $time >= $pm_device5->time) {
                        $Status_Device5 = 'false';
                    } else {
                        $Status_Device5 = 'true';
                    }
                } else {
                    $Status_Device5 = 'true';
                }
            }
        } else {
            $Status_Device5 = null;
            $Name_Device5 = null;
        }

        if (!empty($Name_Device6)) {
            if (empty($pm_device6)) {
                $Status_Device6 = 'true';
            } else {
                if (!empty($pm_device6)) {
                    if ($date >= $pm_device6->date and $date <= $pm_device6->todate
                        and $time >= $pm_device6->time) {
                        $Status_Device6 = 'false';
                    } else {
                        $Status_Device6 = 'true';
                    }
                } else {
                    $Status_Device6 = 'true';
                }
            }
        } else {

            $Status_Device6 = null;
            $Name_Device6 = null;
        }

        if (!empty($Name_Device7)) {
            if (empty($pm_device7)) {
                $Status_Device7 = 'true';
            } else {
                if (!empty($pm_device7)) {
                    if ($date >= $pm_device7->date and $date <= $pm_device7->todate
                        and $time >= $pm_device7->time) {
                        $Status_Device7 = 'false';
                    } else {
                        $Status_Device7 = 'true';
                    }
                } else {
                    $Status_Device7 = 'true';
                }
            }
        } else {
            $Status_Device7 = null;
            $Name_Device7 = null;
        }

        if (!empty($Name_Device8)) {
            if (empty($pm_device8)) {
                $Status_Device8 = 'true';
            } else {
                if (!empty($pm_device8)) {
                    if ($date >= $pm_device8->date and $date <= $pm_device8->todate
                        and $time >= $pm_device8->time) {
                        $Status_Device8 = 'false';
                    } else {
                        $Status_Device8 = 'true';
                    }
                } else {
                    $Status_Device8 = 'true';
                }
            }
        } else {

            $Status_Device8 = null;
            $Name_Device8 = null;
        }

        if (!empty($Name_Device9)) {
            if (empty($pm_device9)) {
                $Status_Device9 = 'true';
            } else {
                if (!empty($pm_device9)) {
                    if ($date >= $pm_device9->date and $date <= $pm_device9->todate
                        and $time >= $pm_device9->time) {
                        $Status_Device9 = 'false';
                    } else {
                        $Status_Device9 = 'true';
                    }
                } else {
                    $Status_Device9 = 'true';
                }
            }
        } else {
            $Status_Device9 = null;
            $Name_Device9 = null;
        }

        if (!empty($Name_Device10)) {
            if (empty($pm_device10)) {
                $Status_Device10 = 'true';
            } else {
                if (!empty($pm_device10)) {
                    if ($date >= $pm_device10->date and $date <= $pm_device10->todate
                        and $time >= $pm_device10->time) {
                        $Status_Device10 = 'false';
                    } else {
                        $Status_Device10 = 'true';
                    }
                } else {
                    $Status_Device10 = 'true';
                }
            }
        } else {

            $Status_Device10 = null;
            $Name_Device10 = null;
        }


        return view('manufacturing.list'
            , compact('Status_Device1', 'Name_Device1'
                , 'Status_Device2', 'Name_Device2'
                , 'Status_Device3', 'Name_Device3'
                , 'Status_Device4', 'Name_Device4'
                , 'Status_Device5', 'Name_Device5'
                , 'Status_Device6', 'Name_Device6'
                , 'Status_Device7', 'Name_Device7'
                , 'Status_Device8', 'Name_Device8'
                , 'Status_Device9', 'Name_Device9'
                , 'Status_Device10', 'Name_Device10'
                , 'formats', 'inserts', 'full_time_stop'));
    }

    public function device1($date, $time)
    {
        $dss1 = PMMachine::where('device_id', 1)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss1 as $ds1) {
            if (!empty($ds1)) {
                if ($date >= $ds1->todate and $time >= $ds1->totime) {
                    PMMachine::find($ds1->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device2($date, $time)
    {
        $dss2 = PMMachine::where('device_id', 2)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss2 as $ds2) {
            if (!empty($ds2)) {
                if ($date >= $ds2->todate and $time >= $ds2->totime) {
                    PMMachine::find($ds2->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device3($date, $time)
    {
        $dss3 = PMMachine::where('device_id', 3)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss3 as $ds3) {
            if (!empty($ds3)) {
                if ($date >= $ds3->todate and $time >= $ds3->totime) {
                    PMMachine::find($ds3->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device4($date, $time)
    {
        $dss4 = PMMachine::where('device_id', 4)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss4 as $ds4) {
            if (!empty($ds4)) {
                if ($date >= $ds4->todate and $time >= $ds4->totime) {
                    PMMachine::find($ds4->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device5($date, $time)
    {
        $dss5 = PMMachine::where('device_id', 5)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss5 as $ds5) {
            if (!empty($ds5)) {
                if ($date >= $ds5->todate and $time >= $ds5->totime) {
                    PMMachine::find($ds5->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device6($date, $time)
    {
        $dss6 = PMMachine::where('device_id', 6)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss6 as $ds6) {
            if (!empty($ds6)) {
                if ($date >= $ds6->todate and $time >= $ds6->totime) {
                    PMMachine::find($ds6->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device7($date, $time)
    {
        $dss7 = PMMachine::where('device_id', 7)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss7 as $ds7) {
            if (!empty($ds7)) {
                if ($date >= $ds7->todate and $time >= $ds7->totime) {
                    PMMachine::find($ds7->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device8($date, $time)
    {
        $dss8 = PMMachine::where('device_id', 8)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss8 as $ds8) {
            if (!empty($ds8)) {
                if ($date >= $ds8->todate and $time >= $ds8->totime) {
                    PMMachine::find($ds8->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device9($date, $time)
    {
        $dss9 = PMMachine::where('device_id', 9)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss9 as $ds9) {
            if (!empty($ds9)) {
                if ($date >= $ds9->todate and $time >= $ds9->totime) {
                    PMMachine::find($ds9->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

    }

    public function device10($date, $time)
    {
        $dss10 = PMMachine::where('device_id', 10)
            ->whereNull('status')
            ->where('date', '>=', $date and 'todate', '<=', $date)
            ->where('time', '>=', $time and 'totime', '<=', $time)
            ->get();
        foreach ($dss10 as $ds10) {
            if (!empty($ds10)) {
                if ($date >= $ds10->todate and $time >= $ds10->totime) {
                    PMMachine::find($ds10->id)->update([
                        'status' => 1,
                    ]);
                }
            }
        }
    }

    public function deviceList1(Request $request)
    {
        if ($request->ajax()) {
            $data = DeviceOrders::where('device_id', 1)
                ->whereNull('end')
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = $row->productorder->product_id;
                    $name = Product::where('id', $product)->first();
                    return $name->label;
                })
                ->addColumn('color', function ($row) {
                    $color = $row->productorder->color_id;
                    $name = Color::where('id', $color)->first();
                    return $name->manufacturer . ' - ' . $name->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->productorder->number;
                })
                ->addColumn('format', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    $name = Format::where('id', $format->format_id)->first();
                    return $name->name;
                })
                ->addColumn('insert', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    $name = Insert::where('id', $format->insert_id)->first();
                    if (!empty($name)) {
                        return $name->name;
                    } else {
                        return '---';
                    }
                })
                ->addColumn('action1', function ($row) {
                    return $this->actions1($row);
                })
                ->addColumn('numberproduced', function ($row) {
                    $number = DB::table('orders_add')
                        ->where('order_id', $row->order_id)
                        ->sum('production');
                    return $number;
                })
                ->rawColumns(['action1'])
                ->make(true);
        }
        return view('manufacturing.list');
    }

    public function deviceList2(Request $request)
    {
        if ($request->ajax()) {
            $data = DeviceOrders::where('device_id', 2)
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = $row->productorder->product_id;
                    $name = Product::where('id', $product)->first();
                    return $name->label;
                })
                ->addColumn('color', function ($row) {
                    $color = $row->productorder->color_id;
                    $name = Color::where('id', $color)->first();
                    return $name->manufacturer . ' - ' . $name->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->productorder->number;
                })
                ->addColumn('format', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    $name = Format::where('id', $format->format_id)->first();
                    return $name->name;
                })
                ->addColumn('insert', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    $name = Insert::where('id', $format->insert_id)->first();
                    if (!empty($name)) {
                        return $name->name;
                    } else {
                        return '---';
                    }
                })
                ->addColumn('size', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('manufacturing.list');
    }

    public function deviceList3(Request $request)
    {
        if ($request->ajax()) {
            $data = DeviceOrders::where('device_id', 3)
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = $row->productorder->product_id;
                    $name = Product::where('id', $product)->first();
                    return $name->label;
                })
                ->addColumn('color', function ($row) {
                    $color = $row->productorder->color_id;
                    $name = Color::where('id', $color)->first();
                    return $name->manufacturer . ' - ' . $name->name;
                })
                ->addColumn('number', function ($row) {
                    return $row->productorder->number;
                })
                ->addColumn('format', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    $name = Format::where('id', $format->format_id)->first();
                    return $name->name;
                })
                ->addColumn('insert', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    $name = Insert::where('id', $format->insert_id)->first();
                    if (!empty($name)) {
                        return $name->name;
                    } else {
                        return '---';
                    }
                })
                ->addColumn('size', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('manufacturing.list');
    }

    public function start1(DeviceOrders $id)
    {
        $data = Carbon::now();
        DB::beginTransaction();
        try {
            DB::table('orders_starts')->insert([
                'order_id' => $id->order_id,
                'created_at' => $data->toDateTimeString(),
                'device_id' => 1,
            ]);
            DB::table('device_orders')
                ->where('order_id', $id->order_id)
                ->update([
                    'state' => 2,
                ]);
            ProductionOrder::find($id->order_id)->update(['status' => 2]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'مشکلی در سیستم رخ داده است!']);
        }
        return response()->json(['success' => 'وضعیت سفارش با موفقیت به در حال تولید تغیر کرد']);
    }

    public function add1(Request $request)
    {
        $order_id = DeviceOrders::where('id', $request->order_id)->first();
        $order = DB::table('production_orders')
            ->where('id', $order_id->order_id)->first();
        $time_end = Carbon::now()->timezone('Asia/Tehran');
        $create = Carbon::now();
        if (!empty($request->id)) {
            DB::beginTransaction();
            try {
                DB::table('orders_add')->where('id', $request->id)->update(
                    [
                        'order_id' => $order_id->order_id,
                        'user_id' => auth()->user()->id,
                        'device_id' => 1,
                        'production' => $request->production,
                        'usable' => $request->usable,
                        'unusable' => $request->unusable,
                        'cycletime' => $request->cycletime,
                        'created_at' => $time_end->toDateTimeString(),
                        'created' => $create->toDateTimeString(),
                    ]);
                DB::table('receiptproduct')
                    ->where('order_id', $request->id)->update([
                        'product_id' => $order->product_id,
                        'color_id' => $order->color_id,
                        'number' => $request->production,
                        'created_at' => $create->toDateTimeString(),
                    ]);
                DB::commit();
                return response()->json(['success' => 'Product saved successfully.']);
            } catch (Exception $exception) {
                DB::rollBack();
                return response()->json(['error' => 'Product saved successfully.']);
            }
        } else {
            DB::beginTransaction();
            try {
                $id = DB::table('orders_add')->insertGetId(
                    [
                        'order_id' => $order_id->order_id,
                        'user_id' => auth()->user()->id,
                        'device_id' => 1,
                        'production' => $request->production,
                        'usable' => $request->usable,
                        'unusable' => $request->unusable,
                        'cycletime' => $request->cycletime,
                        'created_at' => $time_end->toDateTimeString(),
                        'created' => $create->toDateTimeString(),
                    ]);
                DB::table('receiptproduct')->insert([
                    'order_id' => $id,
                    'product_id' => $order->product_id,
                    'color_id' => $order->color_id,
                    'number' => $request->production,
                    'created_at' => $create->toDateTimeString(),
                ]);
                $number = DB::table('orders_add')
                    ->where('order_id', $order_id->order_id)
                    ->sum('production');
                if ($number == $order_id->productiontime) {
                    DeviceOrders::where('order_id', $order_id->order_id)
                        ->update([
                            'end' => 1,
                        ]);
                }

                DB::commit();
                return response()->json(['success' => 'Product saved successfully.']);
            } catch (Exception $exception) {
                DB::rollBack();
                return response()->json(['error' => 'Product saved successfully.']);
            }
        }
    }

    public function detail1(Request $request)
    {
        $id = DeviceOrders::where('id', $request->id)->first();
        if ($request->ajax()) {
            $data = DB::table('orders_add')->where('order_id', $id->order_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function ($row) {
                    $user = User::find($row->user_id)->first();
                    return $user->name;
                })
                ->addColumn('data', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->addColumn('time', function ($row) {
                    return Jalalian::forge($row->created_at)->format('H:i:s');
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('manufacturing.list');
    }

    public function check1(Request $request)
    {
        if (empty($request->cycletime)) {
            return response()->json('null');
        } else {
            $order_id = DeviceOrders::where('id', $request->order_id)->first();
            if (!empty($request->id)) {
                $id_order = DB::table('orders_add')
                    ->where('id', $request->id)
                    ->first();
                $id = DB::table('orders_add')
                    ->where('id', '<', $request->id)
                    ->latest('id')->first();
                if (empty($id)) {
                    $id = DB::table('orders_starts')
                        ->where('order_id', $id_order->order_id)
                        ->first();
                }
                $time_start = Carbon::parse($id->created_at);
                $time_end = Carbon::now()->timezone('Asia/Tehran');
                $second = $time_start->diffInSeconds($time_end);
                $number = $request->production + $request->usable + $request->unusable;
                $number_product = $second / $request->cycletime;
                if ($number > $number_product) {
                    return response()->json(['error' => 'محسابات شما اشتباه میباشد لطفا محسابات را با دقت وارد کنید.']);
                } elseif ($number == $number_product) {
                    return response()->json(['success' => 'محاسبات شما درس میباشد و مجاز به ثبت اطلاعات میباشید.']);
                } elseif ($number < $number_product) {
                    return response()->json(['warning' => 'تعداد تولید شده شما کمتر از حد نصاب تولید تا این لحظه میباشد.']);
                }
            } else {
                $order_add = DB::table('orders_add')
                    ->where('order_id', $order_id->order_id)
                    ->latest('id')->first();
                $time = DB::table('orders_starts')
                    ->where('order_id', $order_id->order_id)
                    ->first();
                if (!empty($order_add)) {
                    $t = $order_add->created;
                } else {
                    $t = $time->created_at;
                }
                $time_start = Carbon::parse($t);
                $time_end = Carbon::now()->timezone('Asia/Tehran');
                $second = $time_start->diffInSeconds($time_end);
                $number = $request->production + $request->usable + $request->unusable;
                $number_product = $second / $request->cycletime;
                if ($number > $number_product) {
                    return response()->json(['error' => 'محسابات شما اشتباه میباشد لطفا محسابات را با دقت وارد کنید.']);
                } elseif ($number == $number_product) {
                    return response()->json(['success' => 'محاسبات شما درس میباشد و مجاز به ثبت اطلاعات میباشید.']);
                } elseif ($number < $number_product) {
                    return response()->json(['warning' => 'تعداد تولید شده شما کمتر از حد نصاب تولید تا این لحظه میباشد.']);
                }
            }
        }
    }

    public function edit1($id)
    {
        $data = DB::table('orders_add')->where('id', $id)->first();
        return response()->json($data);

    }

    public function delete1($id)
    {
        $data = DB::table('orders_add')->where('id', $id)->delete();
        return response()->json($data);

    }

    public function actions1($row)
    {
        $btn = null;
        $status = DB::table('orders_starts')
            ->where('order_id', $row->order_id)
            ->first();
        if (empty($status)) {
            $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="شروع تولید"
                       class="start1">
                       <i class="fa fa-play fa-lg" title="شروع تولید"></i>
                       </a>&nbsp;&nbsp;';
        }
        if (!empty($status)) {


            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ثبت تولید"
                       class="add1">
                       <i class="fa fa-database fa-lg" title="ثبت تولید"></i>
                       </a>';
        }

        return $btn;

    }

    public function actions($row)
    {
        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="edit1">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="delete1">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';

        return $btn;

    }

}
