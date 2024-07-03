<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

use Illuminate\Http\Request;

class User
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


         if(Auth::user()->Role=="User"){
           return $next($request);
         }

         return response()->json(['data'=>'','message'=>'fail','code'=>401,'error'=>'unauthorized']);
 }
}





