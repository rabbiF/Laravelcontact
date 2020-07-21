<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Model\Bien;
use App\Model\Client;
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
        Schema::defaultStringLength(191);
        Blade::component('components.alert', 'alert');
        View::share('bien_number', Bien::all()->count());
        View::share('client_number_total', Client::all()->count());
        View::share('client_number', 0);

        View::composer('*', function($view)
        {
            if (Auth::check()){
                View::share('client_number',  Client::where('user_id',Auth::id() )->count());
            }
        });       
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
