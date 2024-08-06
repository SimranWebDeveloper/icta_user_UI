<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Session;
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
            if (Auth::guard($guard)->check())
                if (Session::get('current_role') == 'administrator') {
                    return redirect()->route('admin.dashboard');
                } elseif (Session::get('current_role') == 'warehouseman') {
                    return redirect()->route('warehouseman.warehouseman');
                } elseif (Session::get('current_role') == 'employee') {
                    return redirect()->route('employee.home');
                } elseif (Session::get('current_role') == 'accountant') {
                    return redirect()->route('accountant.home');
                } elseif (Session::get('current_role') == 'hr') {
                    return redirect()->route('hr.home');
                } elseif (Session::get('current_role') == 'support') {
                    return redirect()->route('support.home');
                }

        }


        return $next($request);
    }
}
