<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers\Resources;

use IlluminateHttpRequest;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;


use PDO;
use Log;
class DirectionsController extends Controller
{
    public function __construct()
   {
       $this->middleware('jwt.auth');
   }
}
