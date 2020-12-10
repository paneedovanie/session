<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        Route::macro('softDeletes', function ($name, $controller) {
            $single = rtrim($name, "s");
            Route::get(sprintf("%s/trashed" ,$name), [$controller, 'trashed'])->name(sprintf("%s.trashed", $name));
            Route::patch(sprintf("%s/{%s}/restore" ,$name, $single), [$controller, 'restore'])->name(sprintf("%s.restore", $name));
            Route::delete(sprintf("%s/{%s}/delete" ,$name, $single), [$controller, 'delete'])->name(sprintf("%s.delete", $name));
        });
    }
}
