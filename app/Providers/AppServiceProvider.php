<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SearchEloquentRepository;
use App\Repositories\SearchRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchRepository::class, SearchEloquentRepository::class);
    }
}
