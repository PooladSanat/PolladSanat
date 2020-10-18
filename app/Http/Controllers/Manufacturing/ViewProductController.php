<?php

namespace App\Http\Controllers\Manufacturing;

use App\BarnsProduct;
use App\BarnTemporary;
use App\Color;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductionOrder;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ViewProductController extends Controller
{
    public function list(Request $request)
    {


        if ($request->ajax()) {
            $data = DB::table('products')
                ->leftJoin('production_orders', 'products.id', '=', 'production_orders.product_id')
                ->distinct()
                ->select('production_orders.color_id', 'production_orders.product_id', 'products.id', 'products.label')
                ->groupBy('production_orders.color_id', 'production_orders.product_id', 'products.id', 'products.label')
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
                ->addColumn('color', function ($row) {
                    $colors = Color::where('id', $row->color_id)->get();
                    foreach ($colors as $color)
                        if (!empty($color)) {
                            return $color->manufacturer . ' - ' . $color->name;
                        } else {
                            return '---';
                        }
                })
                ->addColumn('Inventory', function ($row) {
                    $Inventory = BarnsProduct::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('Inventory');
                    if (!empty($Inventory)) {
                        return $Inventory;
                    } else {
                        return '0';
                    }
                })
                ->addColumn('Orderinprogress', function ($row) {
                    $Orderinprogress = ProductionOrder::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('number');
                    if (!empty($Orderinprogress)) {
                        return $Orderinprogress;
                    } else {
                        return '0';
                    }

                })
                ->addColumn('barntemporary', function ($row) {
                    $barntemporary = BarnTemporary::where('product_id', $row->id)
                        ->where('color_id', $row->color_id)
                        ->sum('number');
                    if (!empty($barntemporary)) {
                        return $barntemporary;
                    } else {
                        return '0';
                    }

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
                ->rawColumns([])
                ->make(true);
        }
        return view('ViewProduction.list');
    }


}
