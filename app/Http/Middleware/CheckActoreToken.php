<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use auth;
//use Illuminate\Support\Actor;

use App\Models\Actor;
class CheckActoreToken
{



    public function handle($request, Closure $next)
    {


            return $next($request);


    }


   protected function redirectTo($request)

    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}



















