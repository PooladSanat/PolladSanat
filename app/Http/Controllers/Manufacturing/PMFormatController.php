<?php

namespace App\Http\Controllers\Manufacturing;

use App\Format;
use App\Http\Controllers\Controller;
use App\PMFormat;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\DataTables;

class PMFormatController extends Controller
{
    public function list(Request $request)
    {
        $formats = Format::all();
        if ($request->ajax()) {
            $data = PMFormat::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('format_id', function ($row) {
                    return $row->format->name;
                })
                ->addColumn('created_at', function ($row) {
                    return Jalalian::forge($row->created_at)->format('Y/m/d');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'فعال';
                    } else {
                        return 'غیرفعال';

                    }
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('pmformat.list', compact('formats'));
    }

    public function store(Request $request)
    {
        PMFormat::updateOrCreate(['id' => $request->product],
            [
                'format_id' => $request->format_id,
                'time' => $request->time,
                'totime' => $request->totime,
                'date' => $this->convert2english($request->date),
                'todate' => $this->convert2english($request->todate),
                'status' => $request->status,
                'cause' => $request->cause,
            ]);
        return response()->json(['success' => 'Product saved successfully.']);


    }

    public function update($id)
    {
        $product = PMFormat::find($id);
        return response()->json($product);
    }

    public function delete($id)
    {
        $post = PMFormat::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    public function actions($row)
    {
        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        return $btn;

    }
    function convert2english($string) {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
}
