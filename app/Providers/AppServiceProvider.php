<?php

namespace App\Providers;

use app\services\CurrencyConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('currency.converter', function () {
            return new CurrencyConverter(config('services.currency_converter.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = request('locale', 'en');
        App::setlocale(request($locale));
        Cookie::queue('local', $locale, 60 * 40 * 356);
        JsonResource::withoutWrapping();
        Paginator::useBootstrap();
    }
}
