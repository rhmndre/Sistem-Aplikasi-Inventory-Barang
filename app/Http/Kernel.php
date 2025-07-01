<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array<string, class-string>
     */
    protected $routeMiddleware = [
        // ...existing code...
        'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}