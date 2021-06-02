<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Facades\Voyager;

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
        ini_set('max_execution_time', 3000000); //300 seconds = 5 minutes
        Schema::defaultStringLength(191);
        Voyager::addAction(\App\Actions\BuilderAction::class);
        Voyager::addAction(\App\Actions\TemplateAction::class);
    }
}
