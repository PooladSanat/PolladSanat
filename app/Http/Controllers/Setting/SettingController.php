<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function wizard()
    {
        $setting = Setting::first();
        return view('setting.wizard', compact('setting'));

    }

    public function store(Request $request)
    {

        Setting::updateOrCreate(['id' => $request->id],$request->all());

        return response()->json(['success' => 'مشخصات با موفقیت در سیستم ثبت شد']);

    }
}
