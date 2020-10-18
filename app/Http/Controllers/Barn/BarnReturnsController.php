<?php

namespace App\Http\Controllers\Barn;

use App\BarnReturns;
use App\Color;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BarnReturnsController extends Controller
{
    public function list(Request $request)
    {

        if ($request->ajax()) {
            $data = BarnReturns::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_id', function ($row) {
                    $product = Product::where('id', $row->product_id)->first();
                    return $product->label;
                })
                ->addColumn('color_id', function ($row) {
                    $color = Color::where('id', $row->color_id)->first();
                    return $color->name;
                })
                ->rawColumns([])
                ->make(true);

        }
        return view('barnreturn.list');


    }
}
