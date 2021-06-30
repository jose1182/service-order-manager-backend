<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request, LoginAction $loginAction){

        $passportRequest = $loginAction->run($request->all());
        $tokenContent = $passportRequest['content'];

        if(!empty($tokenContent['access_token'])){
            return $passportRequest['response'];
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ]);
    }

    public function register(Request $request, RegisterAction $registerAction){
        //try to create a seprate file
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json(['success'=> false,'message' => $validator->errors()], 400);
        }


        $user = $registerAction->run($request->all());

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Registration Failed'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Registration Succeeded']);
    }
}
