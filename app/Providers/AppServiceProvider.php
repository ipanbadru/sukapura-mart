<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::share('alamat', env('ALAMAT', 'Jalan Dalem Wirawangsa KM 3 Cikalapa Desa/ Kec. Tanjungjaya Telp.(0265) 7540257 Kab. Tasikamalaya 46184'));
    }
}
