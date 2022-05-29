<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'employee'){
            return $next($request);
        }else if(Auth::user()->role == 'admin'){

            return redirect(route('admin_dashboard'));

        }else if(Auth::user()->role == 'customer'){

            return redirect(route('customer_dashboard'));
        }
    }
}
