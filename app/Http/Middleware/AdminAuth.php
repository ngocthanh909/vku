<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('logged_in')){
            return $next($request);
        } else {
            session(['code' => 0, 'msg' => "Bạn phải đăng nhập để thực hiện tính năng này!"]);
            return redirect(route('admin.login'));
        }
        
    }
}
