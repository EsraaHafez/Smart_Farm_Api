<?php

namespace App\Http\Controllers\Api;

use App\Models\CartUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\CartUser as CartUserResource;
use App\Models\Cart;
use App\Models\User;
use Auth;

class CartUserController extends Basecontroller
{
    public function index()
    {
        $CartUser = CartUser::all();
        return $this->sendResponse(CartUserResource::collection($CartUser) , 'All Cart sent');

    }


}
