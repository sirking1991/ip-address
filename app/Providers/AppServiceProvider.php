<?php

namespace App\Providers;

use App\Models\IPAddress;
use App\Observers\IPAddressObserver;
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
        IPAddress::observe(IPAddressObserver::class);
    }
}
