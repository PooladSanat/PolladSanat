<?php

namespace App\Http\Controllers\Barn;

use App\Color;
use App\Http\Controllers\Controller;
use App\Polymeric;
use App\Product;
use App\TransferBarn;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class TransferBarnController extends Controller
{
    public function list(Request $request)
    {
        $products = Product::all();
        $colors = Color::all();
        if ($request->ajax()) {
            $data = TransferBarn::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('in_barn', function ($row) {
                    if ($row->in_barn == 1) {
                        return 'پرند';
                    } else {
                        return 'تهرانپارس';
                    }
                })
                ->addColumn('to_barn', function ($row) {
                    if ($row->to_barn == 1) {
                        return 'پرند';
                    } else {
                        return 'تهرانپارس';
                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('TransferBarn.list', compact('products', 'colors'));
    }

    public function store(Request $request)
    {

        $date = Carbon::now()->timezone('Asia/Tehran');
        $v = verta();
        \DB::table('transfer_barns')
            ->insert([
                'user_id' => auth()->user()->id,
                'in_barn' => $request->inbarn,
                'to_barn' => $request->tobarn,
                'date' => Jalalian::forge($date)->format('Y/m/d'),
            ]);

        $id = \DB::table('transfer_barns')->latest('id')->first();


        $number = count(collect($request)->get('type_barnn'));
        try {
            for ($i = 0; $i < $number; $i++) {
                \DB::table('transfer_barns_detail')
                    ->insert([
                        'transfer_barns_id' => $id->id,
                        'type_barn' => $request->get('type_barnn')[$i],
                        'product' => $request->get('productt')[$i],
                        'color' => $request->get('colorr')[$i],
                        'number' => $request->get('numberr')[$i],
                    ]);

                if ($request->get('type_barnn')[$i] == 1
                    or $request->get('type_barnn')[$i] == 2) {
                    \DB::table('receiptproduct')
                        ->insert([
                            'transfer_id' => $id->id,
                            'product_id' => $request->get('productt')[$i],
                            'color_id' => $request->get('colorr')[$i],
                            'number' => $request->get('numberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'Year' => $v->year,
                            'Month' => $v->month,
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }

                if ($request->get('type_barnn')[$i] == 3) {
                    \DB::table('receiptreturn')
                        ->insert([
                            'transfer_id' => $id->id,
                            'product_id' => $request->get('productt')[$i],
                            'color_id' => $request->get('colorr')[$i],
                            'number' => $request->get('numberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }


                if ($request->get('type_barnn')[$i] == 4) {
                    \DB::table('receiptcarncolor')
                        ->insert([
                            'transfer_id' => $id->id,
                            'croncolor_id' => $request->get('productt')[$i],
                            'number' => $request->get('numberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }

                if ($request->get('type_barnn')[$i] == 5) {
                    \DB::table('receiptpolim')
                        ->insert([
                            'transfer_id' => $id->id,
                            'polim_id' => $request->get('productt')[$i],
                            'number' => $request->get('numberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }

            }

        } catch (Exception $exception) {

        }


        return response()->json(['success' => 'success']);

    }

    public function check(Request $request)
    {
        if ($request->type_barn == 1) {
            $products = \DB::table('products')
                ->where('label', 'NOT LIKE', "%D2%")
                ->get();
            return response()->json(['products' => $products]);
        } elseif ($request->type_barn == 2) {
            $product = \DB::table('products')
                ->where('label', 'LIKE', "%D2%")
                ->get();
            return response()->json(['productss' => $product]);
        } elseif ($request->type_barn == 3) {
            $products = \DB::table('products')
                ->where('label', 'NOT LIKE', "%D2%")
                ->get();
            return response()->json(['productsss' => $products]);
        } elseif ($request->type_barn == 4) {
            $colors = Color::all();
            return response()->json(['masterbach' => $colors]);
        } elseif ($request->type_barn == 5) {
            $polymeric = Polymeric::all();
            return response()->json(['polymeric' => $polymeric]);
        }

    }

    public function edit(Request $request)
    {

        $data = \DB::table('transfer_barns')
            ->where('id', $request->id)->first();

        $detail = \DB::table('transfer_barns_detail')
            ->where('transfer_barns_id', $request->id)->get();

        return response()->json(['data' => $data, 'detail_returns' => $detail]);


    }

    public function update(Request $request)
    {

        $date = Carbon::now()->timezone('Asia/Tehran');
        $v = verta();
        \DB::table('transfer_barns')
            ->where('id', $request->idsa)
            ->update([
                'user_id' => auth()->user()->id,
                'in_barn' => $request->inbarnnn,
                'to_barn' => $request->tobarnnnn,
                'date' => Jalalian::forge($date)->format('Y/m/d'),
            ]);


        $transfer_barns_detail = \DB::table('transfer_barns_detail')
            ->where('transfer_barns_id', $request->idsa)
            ->first();
        $receiptproduct = \DB::table('receiptproduct')
            ->where('transfer_id', $request->idsa)
            ->first();
        $receiptreturn = \DB::table('receiptreturn')
            ->where('transfer_id', $request->idsa)
            ->first();
        $receiptcarncolor = \DB::table('receiptcarncolor')
            ->where('transfer_id', $request->idsa)
            ->first();
        $receiptpolim = \DB::table('receiptpolim')
            ->where('transfer_id', $request->idsa)
            ->first();
        if (!empty($transfer_barns_detail)) {
            \DB::table('transfer_barns_detail')
                ->where('transfer_barns_id', $request->idsa)
                ->delete();
        }
        if (!empty($receiptproduct)) {
            \DB::table('receiptproduct')
                ->where('transfer_id', $request->idsa)
                ->delete();
        }
        if (!empty($receiptreturn)) {
            \DB::table('receiptreturn')
                ->where('transfer_id', $request->idsa)
                ->delete();
        }
        if (!empty($receiptcarncolor)) {
            \DB::table('receiptcarncolor')
                ->where('transfer_id', $request->idsa)
                ->delete();
        }
        if (!empty($receiptpolim)) {
            \DB::table('receiptpolim')
                ->where('transfer_id', $request->idsa)
                ->delete();
        }


        $number = count(collect($request)->get('ttype_barnn'));

        try {
            for ($i = 0; $i < $number; $i++) {
                \DB::table('transfer_barns_detail')
                    ->insert([
                        'transfer_barns_id' => $request->idsa,
                        'type_barn' => $request->get('ttype_barnn')[$i],
                        'product' => $request->get('pproductt')[$i],
                        'color' => $request->get('ccolorr')[$i],
                        'number' => $request->get('nnumberr')[$i],
                    ]);

                if ($request->get('ttype_barnn')[$i] == 1
                    or $request->get('ttype_barnn')[$i] == 2) {
                    \DB::table('receiptproduct')
                        ->insert([
                            'transfer_id' => $request->idsa,
                            'product_id' => $request->get('pproductt')[$i],
                            'color_id' => $request->get('ccolorr')[$i],
                            'number' => $request->get('nnumberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'Year' => $v->year,
                            'Month' => $v->month,
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }

                if ($request->get('ttype_barnn')[$i] == 3) {
                    \DB::table('receiptreturn')
                        ->insert([
                            'transfer_id' => $request->idsa,
                            'product_id' => $request->get('pproductt')[$i],
                            'color_id' => $request->get('ccolorr')[$i],
                            'number' => $request->get('nnumberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }


                if ($request->get('ttype_barnn')[$i] == 4) {
                    \DB::table('receiptcarncolor')
                        ->insert([
                            'transfer_id' => $request->idsa,
                            'croncolor_id' => $request->get('pproductt')[$i],
                            'number' => $request->get('nnumberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }

                if ($request->get('ttype_barnn')[$i] == 5) {
                    \DB::table('receiptpolim')
                        ->insert([
                            'transfer_id' => $request->idsa,
                            'polim_id' => $request->get('pproductt')[$i],
                            'number' => $request->get('nnumberr')[$i],
                            'date' => Jalalian::forge($date)->format('Y/m/d'),
                            'barn_id' => $request->tobarn,
                            'created_at' => $date,
                        ]);
                }

            }
            \DB::commit();

        } catch (Exception $exception) {
            \DB::rollBack();
        }
        return response()->json(['success' => 'success']);

    }

    public function actions($row)
    {
        if (empty($row->status)){
            $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                  <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>';
            return $btn;
        }

    }

}
