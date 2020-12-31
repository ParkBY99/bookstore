<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //使用中间件验证是否登陆
        $admin = $request->session()->get('admin','');
        if($admin == ''){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
