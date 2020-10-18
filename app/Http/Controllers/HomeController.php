<?php

namespace App\Http\Controllers;

use App\Color;
use App\Customer;
use App\Invoice;
use App\Product;
use App\Target;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $v = verta();

        $invoices = \DB::table('View_ReportTopCustomer')->limit(5)
            ->where('year', $v->year)
            ->orderBy('number', 'DESC')
            ->get();

        $products = \DB::table('View_ReportTopProduct')->limit(5)
            ->where('year', $v->year)
            ->orderBy('number', 'DESC')
            ->get();
        $product = Product::all();
        $colors = Color::all();
        $customers = Customer::all();

        $users = User::all();
        return view('home', compact('users', 'invoices', 'customers'
            , 'products', 'product', 'colors','v'));
    }

    public function Chart(Request $request)
    {

        $target = Target::where('user_id', $request->id)
            ->where('year', $request->year)
            ->first();
        if ($target != null) {
            $fa = $target->farvardin;
            $ma = $target->may;
            $Ju = $target->June;
            $Ar = $target->Arrows;
            $Au = $target->August;
            $Se = $target->September;
            $sta = $target->stamp;
            $Ab = $target->Aban;
            $Fi = $target->Fire;
            $Ja = $target->January;
            $Av = $target->Avalanche;
            $Ma = $target->March;
        } else {
            $fa = 0;
            $ma = 0;
            $Ju = 0;
            $Ar = 0;
            $Au = 0;
            $Se = 0;
            $sta = 0;
            $Ab = 0;
            $Fi = 0;
            $Ja = 0;
            $Av = 0;
            $Ma = 0;
        }
        $invoices = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->first();
        if (!empty($invoices)) {
            $a = $invoices;
        } else {
            $a = 0;

        }


        $farvardin = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '1')
            ->count();
        $may = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '2')
            ->count();
        $June = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '3')
            ->count();
        $Arrows = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '4')
            ->count();
        $August = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '5')
            ->count();
        $September = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '6')
            ->count();
        $stamp = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '7')
            ->count();
        $Aban = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '8')
            ->count();
        $Fire = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '9')
            ->count();
        $January = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '10')
            ->count();
        $Avalanche = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '11')
            ->count();
        $March = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '12')
            ->count();


        return response(['target' => $target, 'farvardin' => $farvardin
            , 'may' => $may, 'June' => $June, 'Arrows' => $Arrows
            , 'August' => $August, 'September' => $September, 'stamp' => $stamp,
            'Aban' => $Aban, 'Fire' => $Fire, 'January' => $January, 'Avalanche' => $Avalanche
            , 'March' => $March, 'a' => $a, 'fa' => $fa, 'ma' => $ma
            , 'Ju' => $Ju, 'Ar' => $Ar, 'Au' => $Au, 'Se' => $Se, 'sta' => $sta,
            'Ab' => $Ab, 'Fi' => $Fi, 'Ja' => $Ja, 'Ma' => $Ma, 'Av' => $Av

        ]);


    }

    public function ChartSell(Request $request)
    {

        $invoices = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->first();

        $farvardin = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '1')
            ->first();
        if (!empty($farvardin)) {
            $f = $farvardin->price_sell;
        } else {
            $f = 0;
        }

        $may = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '2')
            ->first();
        if (!empty($may)) {
            $m = $may->price_sell;
        } else {
            $m = 0;
        }

        $June = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '3')
            ->first();
        if (!empty($June)) {
            $Ju = $June->price_sell;
        } else {
            $Ju = 0;
        }


        $Arrows = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '4')
            ->first();

        if (!empty($Arrows)) {
            $Ar = $Arrows->price_sell;
        } else {
            $Ar = 0;
        }

        $August = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '5')
            ->first();

        if (!empty($August)) {
            $Au = $August->price_sell;
        } else {
            $Au = 0;
        }


        $September = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '6')
            ->first();

        if (!empty($September)) {
            $Se = $September->price_sell;
        } else {
            $Se = 0;
        }


        $stamp = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '7')
            ->first();


        if (!empty($stamp)) {
            $sta = $stamp->price_sell;
        } else {
            $sta = 0;
        }

        $Aban = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '8')
            ->first();

        if (!empty($Aban)) {
            $Ab = $Aban->price_sell;
        } else {
            $Ab = 0;
        }

        $Fire = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '9')
            ->first();


        if (!empty($Fire)) {
            $Fi = $Fire->price_sell;
        } else {
            $Fi = 0;
        }

        $January = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '10')
            ->first();

        if (!empty($January)) {
            $Ja = $January->price_sell;
        } else {
            $Ja = 0;
        }

        $Avalanche = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '11')
            ->first();

        if (!empty($Avalanche)) {
            $Av = $Avalanche->price_sell;
        } else {
            $Av = 0;
        }

        $March = Invoice::where('user_id', $request->id)
            ->where('Year', $request->year)
            ->where('Month', '12')
            ->first();

        if (!empty($March)) {
            $Ma = $March->price_sell;
        } else {
            $Ma = 0;
        }

        return response(['farvardin' => $f
            , 'may' => $m, 'June' => $Ju, 'Arrows' => $Ar
            , 'August' => $Au, 'September' => $Se, 'stamp' => $sta,
            'Aban' => $Ab, 'Fire' => $Fi, 'January' => $Ja, 'Avalanche' => $Av
            , 'March' => $Ma, 'invoices' => $invoices]);


    }

    public function test()
    {
        return view('test');
    }
}
