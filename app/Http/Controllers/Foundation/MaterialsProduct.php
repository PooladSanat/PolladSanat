<?php

namespace App\Http\Controllers\Foundation;

use App\Http\Controllers\Controller;
use App\Polymeric;
use App\Product;
use App\ProductTitle;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaterialsProduct extends Controller
{
    public function list(Request $request)
    {
        $products = Product::all();
        $polymerics = Polymeric::all();
        if ($request->ajax()) {
            $data = ProductTitle::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    return $row->product->label;
                })
                ->addColumn('checkbox', function ($row) {

                    if ($row->status == 1) {
                        $btn = ' <input type="checkbox" id="checkbox"
                        name="checkbox" checked
                        data-id="' . $row->id . '"
                       class="checkbox">';
                    } else {
                        $btn = ' <input type="checkbox" id="checkbox"
                        name="checkbox"
                        data-id="' . $row->id . '"
                       class="checkbox">';
                    }

                    return $btn;


                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'models', 'checkbox'])
                ->make(true);

        }
        return view('materials.list', compact('products', 'polymerics'));

    }

    public function store(Request $request)
    {


        $product = ProductTitle::create([
            'product_id' => $request->product_id,
        ]);


        try {
            $number = count(collect($request)->get('polymeric_id'));
            for ($i = 0; $i <= $number; $i++) {
                DB::table('product_polyeric')->insert([
                    'productTitle_id' => $product->id,
                    'polymeric_id' => $request->get('polymeric_id')[$i],
                    'percentage' => $request->get('percentage')[$i],
                ]);
            }
        } catch (\Exception $e) {
        }
        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);


    }

    public function update($id)
    {
        $products = Product::all();
        $polymerics = Polymeric::all();
        $product = ProductTitle::find($id);
        $productTitles = DB::table('product_polyeric')
            ->where('productTitle_id', $product->id)
            ->get();

        return view('materials.update', compact('product',
            'products', 'polymerics',
            'productTitles'));


    }

    public function edit(Request $request)
    {

        ProductTitle::find($request->id)->update([
            'product_id' => $request->product_id,
        ]);

        try {
            \DB::table('product_polyeric')
                ->where('productTitle_id', $request->id)
                ->delete();
            $number = count(collect($request)->get('polymeric_id'));
            for ($i = 0; $i <= $number; $i++) {
                DB::table('product_polyeric')->insert([
                    'productTitle_id' => $request->id,
                    'polymeric_id' => $request->get('polymeric_id')[$i],
                    'percentage' => $request->get('percentage')[$i],
                ]);
            }
        } catch (\Exception $e) {
        }
        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);


    }

    public function delete($id)
    {
        $post = ProductTitle::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    public function checkbox($id)
    {
        $product = ProductTitle::find($id);
        $selects = ProductTitle::where('product_id', $product->product_id)->get();
        foreach ($selects as $select)
            $select->update([
                'status' => null,
            ]);
        $product->update([
            'status' => 1,
        ]);
        return response()->json($id);

    }

    public function actions($row)
    {
        $success = url('/public/icon/icons8-edit-144.png');
        $delete = url('/public/icon/icons8-delete-bin-96.png');

        $btn = '<a href="' . route('admin.matrial.update', $row->id) . '">
                        <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';

        return $btn;

    }

}
