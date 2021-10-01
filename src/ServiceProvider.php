<?php

namespace Hellsythe\DomainNameApi;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'domainnameapi');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/domainnameapi.php' => 'domainnameapi'
        ]);

        $this->app->bind('nameapi',function(){
            return new NameApi();
        });
    }
}
