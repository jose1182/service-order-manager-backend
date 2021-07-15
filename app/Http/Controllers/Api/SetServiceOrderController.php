<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SetServiceOrderController extends Controller
{

    public function __construct(){
        //check is user is authenticated
        $this->middleware('auth:api');
    }

    public function store(Request $request){

        //Get the user authenticated
        $user = User::findOrFail(Auth::id());

        //Attach/Detach service order
        $user->servicesOrders()->toggle($request->orderId);

    }
}
