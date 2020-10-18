<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RestPasswordController extends Controller
{
    public function RestPassword(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ], [
            'phone.required' => 'لطفا شماره ثبت شده در سیستم را وارد کنید',
        ]);
        $users = User::where('phone', $request->input('phone'))->get();
        foreach ($users as $user)
            if ($user) {
                $password = rand(999999, 000000);
                session()->flash('pass-success', 'کلمه عبور جدید با موفقیت برای شما ارسال شد');
                return back();
            }
        session()->flash('pass-error', 'شماره وارد شده اشتباه است کاربری با این شماره در سیستم موجود نمیباشد');
        return back();
    }

}
