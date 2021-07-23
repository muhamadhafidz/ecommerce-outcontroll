<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
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
        
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $hcart = Auth::user()->cart()->with(['product.images', 'detail'])->get();
                
            }else{
                $hcart = collect([]);
            }
            // dd($hcart);
            $view->with('hcart', $hcart);
        });
        // View::share('data', $data);
    }
}
