<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ManajemenUser;

class MultiAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register the default users provider
        Auth::provider('users', function ($app, array $config) {
            return new \Illuminate\Auth\EloquentUserProvider($app['hash'], User::class);
        });

        // Register the manajemen users provider
        Auth::provider('manajemen_users', function ($app, array $config) {
            return new \Illuminate\Auth\EloquentUserProvider($app['hash'], ManajemenUser::class);
        });
    }
} 