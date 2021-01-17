<?php

namespace App\Providers;

use App\Events\TotalUsers;
use App\User;
use Illuminate\Support\Facades\Event;
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
        /* User::created(function($item){
            Event::fire(new TotalUsers($item));
        });

        User::updated(function($item){
            Event::fire(new TotalUsers($item));
        });

        User::deleted(function($item){
            Event::fire(new TotalUsers($item));
        }); */
    }
}
