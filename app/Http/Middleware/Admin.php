<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin
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
        // dd('aaaaa');
        if(isset($request->session()->get('loginUser')->role) && $request->session()->get('loginUser')->role->user_type == 'admin'){
            return $next($request);
        }

        return redirect('admin/login')->with('error','you are unauthorized');

    }
}
