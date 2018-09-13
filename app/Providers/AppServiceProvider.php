<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if('ows', function ($user_id)
        {
            return Auth::check() && Auth::id() == $user_id;
        });
        
        \Blade::if('isFollowed', function ($method, $field, $id)
        {
            return Auth::check() && Auth::user()->$method()->where($field, $id)->count();
        });

        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
