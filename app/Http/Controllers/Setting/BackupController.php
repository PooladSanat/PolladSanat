<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    /**
     * گرفتن نسخه پشتیبان از دیتابیس
     */
    public function backup()
    {
        return response()->json(['success' => 'عملیات پشتیبان گیری با موفقیت انجام شد']);
        \Artisan::call('backup:run');
        return response()->json(['success' => 'عملیات پشتیبان گیری با موفقیت انجام شد']);
    }
}
