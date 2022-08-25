<?php

namespace App\Providers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\ServiceProvider;
use App\Models\RequestBarang;

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
        $reqMenunggu = RequestBarang::where('status','menunggu')->latest()->get();
        return view()->share('reqMenunggu', $reqMenunggu);
    }
}
