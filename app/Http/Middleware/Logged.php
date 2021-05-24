<?php

namespace App\Http\Middleware;

use Closure;

class Logged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(
            $request->session()->get('user_nickname') != null 
            && $request->session()->get('user_nickname') != ''
            && $request->session()->get('user_id') != null 
            && intval($request->session()->get('user_id')) != 0
            && $request->session()->get('user_permission') != null
            && (intval($request->session()->get('user_permission')) == 1 || (intval($request->session()->get('user_permission')) == 2)) 
        ){
            return $next($request);
        }
        return redirect('/');
    }
}
