<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                // Redirect based on user role
                switch($user->hak_akses) {
                    case 'superadmin':
                        return redirect()->route('superadmin.dashboard');
                    case 'admin_barang':
                        return redirect()->route('adminbarang.kelolabarang.index');
                    case 'kepala_gudang':
                        return redirect()->route('dashboard');
                    default:
                        return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
} 