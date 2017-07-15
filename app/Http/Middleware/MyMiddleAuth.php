<?php

namespace App\Http\Middleware;

use Closure;

class MyMiddleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if( !$request->session()->has('remember_token')){
            return "你好，请先登录";
        }
       $this->remember_token=$request->session()->get('remember_token');

        return $next($request);
    }

}
