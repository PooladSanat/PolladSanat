<?php

namespace App\Http\Controllers;

use App\DeviceOrders;
use App\Test;
use App\User;
use DB;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
    public function showDatatable()
    {
        $device_orders = DeviceOrders::where('device_id', 1)
            ->orderBy('order', 'ASC')->get();

        return view('test', compact('device_orders'));
    }

    public function updateOrder(Request $request)
    {
        return response()->json('okkkkkkkkkkkkk');

        $tasks = DeviceOrders::all();
        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update([
                        'order' => $order['position']
                    ]);


                }
            }
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }

    public function test(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.show');
    }


    public function testttt()
    {
        $a = DNS1D::getBarcodeHTML('P-98121167', 'C93');
        return view('barcode', compact('a'));
    }

    public function estttt()
    {
        $t = $this->num2word('100,000');
        dd($t);
    }


    public function refresh(Request $request)
    {
        $device_orders = DeviceOrders::where('device_id', 1)
            ->orderBy('order', 'ASC')->get();

        return response()->json($device_orders);

    }

    public function reorder(Request $request)
    {

        foreach ($request->input('rows', []) as $row) {
            $data = DeviceOrders::find($row['id'])->update([
                'Order' => $row['position']
            ]);
        }

        return response()->json($data);
    }


    public function table()
    {
        return view('table');

    }


    public function g(Request $request)
    {
        DB::insert('CALL Sp_Insert_Users (?,?,?,?,?,?)',
            array(123456, 123456, 123456, 123456, null, null));

    }


    function num2word($num)
    {
        $num = (string)$num;
        $one = array('', 'یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه');
        $ten = array('', '', 'بیست', 'سی', 'چهل', 'پنجاه', 'شصت', 'هفتاد', 'هشتاد', 'نود',);
        $hundred = array('', 'یکصد', 'دویست', 'سیصد', 'چهارصد', 'پانصد', 'ششصد', 'هفتصد', 'هشتصد', 'نهصد',);
        $categories = array('', 'هزار', 'میلیون', 'میلیارد', 'بیلیون', 'بیلیارد', 'تریلیون', 'تریلیارد', 'کوآدریلیون',);
        $exceptions = array('ده', 'یازده', 'دوازده', 'سیزده', 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده',);
        $out = '';
        $j = 0;
        $cnt = strlen($num);
        if ($cnt == 1)
            return $one[$num];
        for ($i = --$cnt; $i >= 0; $i -= 3) {
            $add = '';
            $i1 = $num[$i];
            $i2 = isset($num[$i - 1]) ? $num[$i - 1] : '';
            $i3 = isset($num[$i - 2]) ? $num[$i - 2] : '';
            if (!empty($i3))
                $add .= $hundred[$i3] . ' , ';
            if ($i2 > 1)
                $add .= $ten[$i2] . ' , ' . $one[$i1] . ' ';
            elseif ($i2 == 1)
                $add .= $exceptions[$i1] . ' ';
            else
                $add .= $one[$i1] . ' ';
            if ($add != ' ')
                $add .= $categories[$j++] . ' , ';
            else
                $j++;
            $out = $add . $out;
        }
        return mb_substr($out, 0, -4);
    }

}
