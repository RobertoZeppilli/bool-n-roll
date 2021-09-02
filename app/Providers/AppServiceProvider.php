<?php

namespace App\Providers;

use Braintree\Configuration;

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
        Configuration::environment(env('BT_ENVIRONMENT'));
        Configuration::merchantId(env('BT_MERCHANT_ID'));
        Configuration::publicKey(env('BT_PUBLIC_KEY'));
        Configuration::privateKey(env('BT_PRIVATE_KEY'));
    }
}
