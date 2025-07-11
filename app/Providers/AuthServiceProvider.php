<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for role-based access
        Gate::define('superadmin', function ($user) {
            return $user->hak_akses === 'superadmin';
        });

        Gate::define('admin_barang', function ($user) {
            return $user->hak_akses === 'admin_barang';
        });

        Gate::define('kepala_gudang', function ($user) {
            return $user->hak_akses === 'kepala_gudang';
        });
    }
} 