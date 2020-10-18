<?php

namespace App\Http\Controllers\Manufacturing;

use App\Color;
use App\ColorChange;
use App\Device;
use App\DeviceOrders;
use App\EventsFormat;
use App\EventsMachine;
use App\Format;
use App\Http\Controllers\Controller;
use App\Insert;
use App\PMMachine;
use App\Product;
use App\ProductionOrder;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DB;
use Faker\Provider\DateTime;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class ProductionPlanningController extends Controller
{
    private $count1;
    private $id;
    private $count2;
    private $count3;
    private $count4;
    private $count5;

    public function list()
    {

        $dt = Carbon::now()->timezone('Asia/Tehran');
        $time = Jalalian::forge($dt)->format('H:i');
        $date = Jalalian::forge(date('Y/m/d'))->format('Y/m/d');

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


        return view('productionplanning.list'
            , compact('Status_Device1', 'Name_Device1'
                , 'Status_Device2', 'Name_Device2'
                , 'Status_Device3', 'Name_Device3'
                , 'Status_Device4', 'Name_Device4'
                , 'Status_Device5', 'Name_Device5'
                , 'Status_Device6', 'Name_Device6'
                , 'Status_Device7', 'Name_Device7'
                , 'Status_Device8', 'Name_Device8'
                , 'Status_Device9', 'Name_Device9'
                , 'Status_Device10', 'Name_Device10'));
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

    public function deviceproduct1(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('addTOdevice1', function ($row) {
                    return $this->addTOdevice1($row);
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['addTOdevice1', 'color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function deviceproductfalse1(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function Ldevice1(Request $request)
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
                ->addColumn('deleteINdevice1', function ($row) {
                    return $this->deleteINdevice1($row);
                })
                ->addColumn('state', function ($row) {
                    if ($row->state == 1) {
                        return 'در صف تولید';
                    } elseif ($row->state) {
                        return 'در حال تولید';
                    }
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
                ->addColumn('cycletime', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    return $format->cycletime;
                })
                ->addColumn('size', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('productiontime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    }
                })
                ->addColumn('remainingtime', function ($row) {

                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('productionqueue', function ($row) {
                    return $this->productionqueue1($row);

                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;
                })
                ->addColumn('Productionbalance', function ($row) {

                    return $row->productorder->number;
                })
                ->rawColumns(['deleteINdevice1'])
                ->make(true);
        }
        return view('productionplanning.list');
    }

    public function AddDevice1($id)
    {
        $product_id = ProductionOrder::where('id', $id)
            ->first();
        $format = DB::table('model_products')
            ->where('product_id', $product_id->product_id)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $number = ProductionOrder::where('id', $id)
            ->first();
        $t = $number->number / $name->quetta;
        $v = $t * $format->cycletime;
        DB::beginTransaction();
        try {
            ProductionOrder::find($id)->update([
                'status' => 1,
            ]);
            $device = DeviceOrders::create([
                'device_id' => 1,
                'order_id' => $id,
                'productiontime' => $v,
                'state' => 1,
            ]);
            DeviceOrders::find($device->id)->update([
                'Order' => $device->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'error']);
        }
        return response()->json(['success' => 'success']);
    }

    public function DeleteDevice1($id)
    {
        $update = DeviceOrders::where('id', $id)
            ->first();
        DB::beginTransaction();
        try {
            ProductionOrder::find($update->order_id)->update([
                'status' => 0,
            ]);
            DeviceOrders::where('id', $id)
                ->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'error']);
        }
        return response()->json(['success' => 'success']);
    }

    public function SortDevice1(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            $data = DeviceOrders::find($row['id'])->update([
                'Order' => $row['position']
            ]);
        }

        return response()->json($data);
    }

    public function deviceproduct2(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('addTOdevice2', function ($row) {
                    return $this->addTOdevice2($row);
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['addTOdevice2', 'color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function deviceproductfalse2(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function Ldevice2(Request $request)
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
                ->addColumn('deleteINdevice2', function ($row) {
                    return $this->deleteINdevice2($row);
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
                ->addColumn('cycletime', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    return $format->cycletime;
                })
                ->addColumn('size', function ($row) {
                    $product_id = $row->productorder->product_id;
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('productiontime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    }
                })
                ->addColumn('remainingtime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';
                    }
                })
                ->addColumn('productionqueue2', function ($row) {
                    return $this->productionqueue2($row);
                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;

                })
                ->addColumn('Productionbalance', function ($row) {
                    return $row->productorder->number;
                })
                ->rawColumns(['deleteINdevice2'])
                ->make(true);
        }
        return view('productionplanning.list');
    }

    public function AddDevice2($id)
    {
        $product_id = ProductionOrder::where('id', $id)
            ->first();
        $format = DB::table('model_products')
            ->where('product_id', $product_id->product_id)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $number = ProductionOrder::where('id', $id)
            ->first();
        $t = $number->number / $name->quetta;
        $v = $t * $format->cycletime;
        DB::beginTransaction();
        try {
            ProductionOrder::find($id)->update([
                'status' => 1,
            ]);
            $device = DeviceOrders::create([
                'device_id' => 2,
                'order_id' => $id,
                'productiontime' => $v,
            ]);
            DeviceOrders::find($device->id)->update([
                'Order' => $device->id,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'error']);
        }
        return response()->json(['success' => 'success']);
    }

    public function DeleteDevice2($id)
    {
        $update = DeviceOrders::where('id', $id)
            ->first();
        DB::beginTransaction();
        try {
            ProductionOrder::find($update->order_id)->update([
                'status' => 0,
            ]);
            DeviceOrders::where('id', $id)
                ->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'error']);
        }
        return response()->json(['success' => 'success']);


    }

    public function SortDevice2(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            $data = DeviceOrders::find($row['id'])->update([
                'Order' => $row['position']
            ]);
        }

        return response()->json($data);
    }

    public function deviceproduct3(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('addTOdevice3', function ($row) {
                    return $this->addTOdevice3($row);
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['addTOdevice3', 'color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function deviceproductfalse3(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function Ldevice3(Request $request)
    {


        if ($request->ajax()) {
            $data = DeviceOrders::where('device_id', 3)
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $name = Product::where('id', $product->product_id)->first();
                    return $name->label;
                })
                ->addColumn('deleteINdevice3', function ($row) {
                    return $this->deleteINdevice3($row);
                })
                ->addColumn('color', function ($row) {
                    $color = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $name = Color::where('id', $color->color_id)->first();
                    return $name->manufacturer . ' - ' . $name->name;
                })
                ->addColumn('number', function ($row) {
                    $number = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    return $number->number;
                })
                ->addColumn('format', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    $name = Format::where('id', $format->format_id)->first();
                    return $name->name;
                })
                ->addColumn('insert', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    $name = Insert::where('id', $format->insert_id)->first();
                    if (!empty($name)) {
                        return $name->name;
                    } else {
                        return '---';
                    }
                })
                ->addColumn('cycletime', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    return $format->cycletime;
                })
                ->addColumn('size', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('productiontime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('remainingtime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('productionqueue3', function ($row) {
                    return $this->productionqueue3($row);

                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;

                })
                ->addColumn('Productionbalance', function ($row) {
                    $number = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    return $number->number;
                })
                ->rawColumns(['deleteINdevice3'])
                ->make(true);
        }
        return view('productionplanning.list');
    }

    public function AddDevice3($id)
    {
        $product_id = ProductionOrder::where('id', $id)
            ->first();
        $format = DB::table('model_products')
            ->where('product_id', $product_id->product_id)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $number = ProductionOrder::where('id', $id)
            ->first();
        $t = $number->number / $name->quetta;
        $v = $t * $format->cycletime;
        DB::beginTransaction();
        try {
            ProductionOrder::find($id)->update([
                'status' => 1,
            ]);
            $device = DeviceOrders::create([
                'device_id' => 3,
                'order_id' => $id,
                'productiontime' => $v,
            ]);
            DeviceOrders::find($device->id)->update([
                'Order' => $device->id,
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'error']);
        }
        return response()->json(['success' => 'success']);
    }

    public function DeleteDevice3($id)
    {

        $update = DeviceOrders::where('id', $id)
            ->first();
        DB::beginTransaction();
        try {
            ProductionOrder::find($update->order_id)->update([
                'status' => 0,
            ]);
            DeviceOrders::where('id', $id)
                ->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'error']);
        }
        return response()->json(['success' => 'success']);
    }

    public function SortDevice3(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            $data = DeviceOrders::find($row['id'])->update([
                'Order' => $row['position']
            ]);
        }

        return response()->json($data);
    }

    public function deviceproduct4(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('addTOdevice4', function ($row) {
                    return $this->addTOdevice4($row);
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['addTOdevice4', 'color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function Ldevice4(Request $request)
    {


        if ($request->ajax()) {
            $data = DeviceOrders::where('device_id', 4)
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $name = Product::where('id', $product->product_id)->first();
                    return $name->label;
                })
                ->addColumn('deleteINdevice4', function ($row) {
                    return $this->deleteINdevice4($row);
                })
                ->addColumn('color', function ($row) {
                    $color = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $name = Color::where('id', $color->color_id)->first();
                    return $name->manufacturer . ' - ' . $name->name;
                })
                ->addColumn('number', function ($row) {
                    $number = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    return $number->number;
                })
                ->addColumn('format', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    $name = Format::where('id', $format->format_id)->first();
                    return $name->name;
                })
                ->addColumn('insert', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    $name = Insert::where('id', $format->insert_id)->first();
                    if (!empty($name)) {
                        return $name->name;
                    } else {
                        return '---';
                    }
                })
                ->addColumn('cycletime', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    return $format->cycletime;
                })
                ->addColumn('size', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('productiontime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('remainingtime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('productionqueue4', function ($row) {
                    return $this->productionqueue4($row);

                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;

                })
                ->addColumn('Productionbalance', function ($row) {
                    $number = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    return $number->number;
                })
                ->rawColumns(['deleteINdevice4'])
                ->make(true);
        }
        return view('productionplanning.list');
    }

    public function AddDevice4($id)
    {

        $product_id = ProductionOrder::where('id', $id)
            ->first();
        $format = DB::table('model_products')
            ->where('product_id', $product_id->product_id)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $number = ProductionOrder::where('id', $id)
            ->first();
        $t = $number->number / $name->quetta;
        $v = $t * $format->cycletime;
        ProductionOrder::find($id)->update([
            'status' => 1,
        ]);
        $device = DeviceOrders::create([
            'device_id' => 4,
            'order_id' => $id,
            'productiontime' => $v,
        ]);
        DeviceOrders::find($device->id)->update([
            'Order' => $device->id,
        ]);

        return response()->json();
    }

    public function DeleteDevice4($id)
    {

        $update = DeviceOrders::where('id', $id)
            ->first();
        ProductionOrder::find($update->order_id)->update([
            'status' => 0,
        ]);
        DeviceOrders::where('id', $id)
            ->delete();
        return response()->json();
    }

    public function SortDevice4(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            $data = DeviceOrders::find($row['id'])->update([
                'Order' => $row['position']
            ]);
        }

        return response()->json($data);
    }

    public function deviceproduct5(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductionOrder::orderBy('id', 'desc')
                ->where('status', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('addTOdevice5', function ($row) {
                    return $this->addTOdevice5($row);
                })
                ->addColumn('color_id', function ($row) {
                    $name = '<span>' . $row->color->manufacturer . ' - ' . $row->color->name . '</span>';
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->rawColumns(['addTOdevice5', 'color_id'])
                ->make(true);
        }
        return view('ProductionOrder.list');
    }

    public function Ldevice5(Request $request)
    {


        if ($request->ajax()) {
            $data = DeviceOrders::where('device_id', 5)
                ->orderBy('Order', 'ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    $product = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $name = Product::where('id', $product->product_id)->first();
                    return $name->label;
                })
                ->addColumn('deleteINdevice5', function ($row) {
                    return $this->deleteINdevice5($row);
                })
                ->addColumn('color', function ($row) {
                    $color = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $name = Color::where('id', $color->color_id)->first();
                    return $name->manufacturer . ' - ' . $name->name;
                })
                ->addColumn('number', function ($row) {
                    $number = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    return $number->number;
                })
                ->addColumn('format', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    $name = Format::where('id', $format->format_id)->first();
                    return $name->name;
                })
                ->addColumn('insert', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    $name = Insert::where('id', $format->insert_id)->first();
                    if (!empty($name)) {
                        return $name->name;
                    } else {
                        return '---';
                    }
                })
                ->addColumn('cycletime', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    return $format->cycletime;
                })
                ->addColumn('size', function ($row) {
                    $product_id = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    $format = DB::table('model_products')
                        ->where('product_id', $product_id->product_id)
                        ->first();
                    return $format->size;
                })
                ->addColumn('productiontime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('remainingtime', function ($row) {
                    $days = intval(intval($row->productiontime) / (3600 * 24));
                    $h = intval($row->productiontime % (24 * 3600));
                    $hour = intval($h / 3600);
                    $m = intval($h % 3600);
                    $minutes = intval($m / 60);
                    $seconds = intval($m % 60);
                    if ($row->productiontime >= 86400) {
                        return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } elseif ($row->productiontime >= 3600) {
                        return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    } else {
                        return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

                    }

                })
                ->addColumn('productionqueue5', function ($row) {
                    return $this->productionqueue5($row);

                })
                ->addColumn('numberproduced', function ($row) {
                    return 0;

                })
                ->addColumn('Productionbalance', function ($row) {
                    $number = ProductionOrder::where('id', $row->order_id)
                        ->first();
                    return $number->number;
                })
                ->rawColumns(['deleteINdevice5'])
                ->make(true);
        }
        return view('productionplanning.list');
    }

    public function AddDevice5($id)
    {

        $product_id = ProductionOrder::where('id', $id)
            ->first();
        $format = DB::table('model_products')
            ->where('product_id', $product_id->product_id)
            ->first();
        $name = Format::where('id', $format->format_id)->first();
        $number = ProductionOrder::where('id', $id)
            ->first();
        $t = $number->number / $name->quetta;
        $v = $t * $format->cycletime;
        ProductionOrder::find($id)->update([
            'status' => 1,
        ]);
        $device = DeviceOrders::create([
            'device_id' => 5,
            'order_id' => $id,
            'productiontime' => $v,
        ]);
        DeviceOrders::find($device->id)->update([
            'Order' => $device->id,
        ]);

        return response()->json();
    }

    public function DeleteDevice5($id)
    {

        $update = DeviceOrders::where('id', $id)
            ->first();
        ProductionOrder::find($update->order_id)->update([
            'status' => 0,
        ]);
        DeviceOrders::where('id', $id)
            ->delete();
        return response()->json();
    }

    public function SortDevice5(Request $request)
    {
        foreach ($request->input('rows', []) as $row) {
            $data = DeviceOrders::find($row['id'])->update([
                'Order' => $row['position']
            ]);
        }

        return response()->json($data);
    }

    public function productionqueue1($row)
    {

        $count = $this->count1 += $row->productiontime;
        $color = $this->color($row);
        $format = $this->format($row);
        $insert = $this->insert($row);
        $sum = $color + $count + $format + $insert;
        $days = intval(intval($sum) / (3600 * 24));
        $h = intval($sum % (24 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);
        if ($sum >= 86400) {
            return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } elseif ($sum >= 3600) {
            return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } else {
            return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        }


    }

    public function productionqueue2($row)
    {

        $count2 = $this->count2 += $row->productiontime;
        $color = $this->color($row);
        $format = $this->format($row);
        $insert = $this->insert($row);
        $sum = $color + $count2 + $format + $insert;
        $days = intval(intval($sum) / (3600 * 24));
        $h = intval($sum % (24 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);
        if ($sum >= 86400) {
            return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } elseif ($sum >= 3600) {
            return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } else {
            return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        }


    }

    public function productionqueue3($row)
    {

        $count3 = $this->count3 += $row->productiontime;
        $color = $this->color($row);
        $format = $this->format($row);
        $insert = $this->insert($row);
        $sum = $color + $count3 + $format + $insert;
        $days = intval(intval($sum) / (3600 * 24));
        $h = intval($sum % (24 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);
        if ($sum >= 86400) {
            return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } elseif ($sum >= 3600) {
            return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } else {
            return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        }


    }

    public function productionqueue4($row)
    {

        $count4 = $this->count4 += $row->productiontime;
        $color = $this->color($row);
        $format = $this->format($row);
        $insert = $this->insert($row);
        $sum = $color + $count4 + $format + $insert;
        $days = intval(intval($sum) / (3600 * 24));
        $h = intval($sum % (24 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);
        if ($sum >= 86400) {
            return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } elseif ($sum >= 3600) {
            return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } else {
            return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        }


    }

    public function productionqueue5($row)
    {

        $count5 = $this->count5 += $row->productiontime;
        $color = $this->color($row);
        $format = $this->format($row);
        $insert = $this->insert($row);
        $sum = $color + $count5 + $format + $insert;
        $days = intval(intval($sum) / (3600 * 24));
        $h = intval($sum % (24 * 3600));
        $hour = intval($h / 3600);
        $m = intval($h % 3600);
        $minutes = intval($m / 60);
        $seconds = intval($m % 60);
        if ($sum >= 86400) {
            return $days . ' روز ' . $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } elseif ($sum >= 3600) {
            return $hour . ' ساعت ' . $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        } else {
            return $minutes . ' دقیقه ' . $seconds . ' ثانیه ';

        }


    }

    public function color($row)
    {
        $test = DeviceOrders::where('Order', '<', $row->Order)->max('Order');
        if (!empty($test)) {
            $count = DeviceOrders::where('Order', $test)->first();
            $tes = ProductionOrder::where('id', $count->order_id)->first();
            $color = Color::where('id', $tes->color_id)->first();
            $tess = ProductionOrder::where('id', $row->order_id)->first();
            $colorr = Color::where('id', $tess->color_id)->first();
            if ($color->id != $colorr->id) {
                $c = ColorChange::where('ofColor_id', $color->id)
                    ->where('toColor_id', $colorr->id)
                    ->first();
                $seconds = intval($c->time * 60);
                return $seconds;
            } else {
                return 0;
            }
        }
    }

    public function format($row)
    {
        $test = DeviceOrders::where('Order', '<', $row->Order)->max('Order');
        if (!empty($test)) {
            $count = DeviceOrders::where('Order', $test)->first();
            $tes = ProductionOrder::where('id', $count->order_id)->first();
            $modalProduct = DB::table('model_products')->where('product_id', $tes->product_id)
                ->first();
            $format = Format::where('id', $modalProduct->format_id)->first();

            $tess = ProductionOrder::where('id', $row->order_id)->first();
            $modalProductt = DB::table('model_products')
                ->where('product_id', $tess->product_id)
                ->first();
            $formatt = Format::where('id', $modalProductt->format_id)->first();
            if ($format->id != $formatt->id) {
                $format_time = intval($format->time * 60);
                return $format_time;
            } else {
                return 0;
            }


        }
    }

    public function insert($row)
    {
        $test = DeviceOrders::where('Order', '<', $row->Order)->max('Order');
        if (!empty($test)) {
            $count = DeviceOrders::where('Order', $test)->first();
            $tes = ProductionOrder::where('id', $count->order_id)->first();
            $modalProduct = DB::table('model_products')
                ->where('product_id', $tes->product_id)
                ->first();
            $format = Insert::where('id', $modalProduct->insert_id)->first();

            $tess = ProductionOrder::where('id', $row->order_id)->first();
            $modalProductt = DB::table('model_products')
                ->where('product_id', $tess->product_id)
                ->first();
            $formatt = Insert::where('id', $modalProductt->insert_id)->first();
            if ($format->id != $formatt->id) {
                $format_time = intval($format->time * 60);
                return $format_time;
            } else {
                return 0;
            }


        }
    }

    public function addTOdevice1($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="addTOdevice1">
                       <i class="fa fa-arrow-right fa-lg" title="انتصاب به ماشین"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function addTOdevice2($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="addTOdevice2">
                       <i class="fa fa-arrow-right fa-lg" title="انتصاب به ماشین"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function addTOdevice3($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="addTOdevice3">
                       <i class="fa fa-arrow-right fa-lg" title="انتصاب به ماشین"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function addTOdevice4($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="addTOdevice4">
                       <i class="fa fa-arrow-right fa-lg" title="انتصاب به ماشین"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function addTOdevice5($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="addTOdevice5">
                       <i class="fa fa-arrow-right fa-lg" title="انتصاب به ماشین"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function deleteINdevice1($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="deleteINdevice1">
                       <i class="fa fa-arrow-left fa-lg" title="ازاد کردن سفارش"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function deleteINdevice2($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="deleteINdevice2">
                       <i class="fa fa-arrow-left fa-lg" title="ازاد کردن سفارش"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function deleteINdevice3($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="deleteINdevice3">
                       <i class="fa fa-arrow-left fa-lg" title="ازاد کردن سفارش"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function deleteINdevice4($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="deleteINdevice4">
                       <i class="fa fa-arrow-left fa-lg" title="ازاد کردن سفارش"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

    public function deleteINdevice5($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="deleteINdevice5">
                       <i class="fa fa-arrow-left fa-lg" title="ازاد کردن سفارش"></i>
                       </a>&nbsp;&nbsp;';

        return $btn;

    }

}
