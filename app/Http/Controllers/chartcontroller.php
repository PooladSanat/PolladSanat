<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use DB;
use Illuminate\Http\Request;

class chartcontroller extends Controller
{
    public function index()
    {
        $users = Invoice::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
            ->title("جمع فروشهای امسال به تفکیک ماه")
            ->elementLabel("جمع فروش")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByMonth(date('Y'), true);
        return view('chart.home', ['chart' => $chart]);
    }
}
