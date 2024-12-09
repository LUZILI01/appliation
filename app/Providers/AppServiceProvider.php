<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\User as AppUser; // change to AppUser

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Gate $gate): void
    {
        Model::unguard();

        $gate->define('admin', function (AppUser $user) { //  AppUser
            return $user->id == '7';
        });
    }
}