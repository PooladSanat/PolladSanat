<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        function MsgSuccess($msg)
        {
            return redirect()->back()->with('msg-success', $msg);
        }

        function MsgError($msg)
        {
            return redirect()->back()->with('msg-error', $msg);
        }

        function MsgInfo($msg)
        {
            return redirect()->back()->with('msg-info', $msg);
        }


    }
}
