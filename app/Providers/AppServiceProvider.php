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
	
		// Abstracted common letters logic away from view
		$letters = explode(" ","A B C D E F G H I J K L M N O P Q R S T U V W X Y Z");


		\View::share('letters', $letters);

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
