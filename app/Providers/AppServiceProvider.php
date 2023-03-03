<?php

namespace App\Providers;

use App\Service\TravioService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TravioService::class, function(Application $app){

            $service = new TravioService();
            $service->setTravioKey(config('services.travio.key'));
            $service->setTravioId(config('services.travio.id'));
            $service->setTravioUrl(config('services.travio.url'));

            return $service;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
