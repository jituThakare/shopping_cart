<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthorize
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
       if( Auth::user()->email == 'jitu@gmail.com' ){
        //   dd(Auth::user()->email);
        // session('isTeacher', true);
           return $next($request);
             
       }else{
        //    dd("not admin");
        return back()->with('message', "you are not admin");
       }

       
    }
}
