<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use auth;
//use Illuminate\Support\Actor;
use App\Models\User;
use App\Models\Actor;


//use Illuminate\Auth\Middleware\Authenticate as Middleware;
//class CheckActoreToken extends Middleware
class CheckActoreToken
{
/*
 protected function redirectTo($request)

    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

  public function handle($request, Closure $next)
    {

        return $next($request);
        /*  if(Auth::check() && Auth::user()->isAdmin()){
            return $next($request);
        }
        else{
            abort(response()->json(
                [
                    'api_status' => '401',
                    'message' => 'UnAuthenticated , ' .
                    'you must login as a Admin for this Route',
                ], 401));
        } */
   // }
/*
     protected function unauthenticated($request, array $guards)
    {
        abort(response()->json(
            [
                'api_status' => '401',
                'message' => 'UnAuthenticated , ' .
                'you must login as a Admin for this Route',
            ], 401));
    }


*/


    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null)
            auth()->shouldUse($guard);
        return $next($request);
    }








}



















