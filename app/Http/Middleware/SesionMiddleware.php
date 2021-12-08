<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SesionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        $num = rand(1,100);
        if ($request->session()->exists('token')){
            return $next($request);
        } else{
            return redirect('login');
        }
    }
}
