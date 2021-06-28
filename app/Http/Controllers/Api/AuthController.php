<?php

namespace App\Http\Controllers\Api;

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
    public function login(Request $request){

        $passwordGrandClient = Client::where('password_client', 1)->first();

        $data = [
            'grant_type' => 'password',
            'client_id' => $passwordGrandClient->id,
            'client_secret' => $passwordGrandClient->secret,
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'scope' => '*',
        ];

        $tokenRequest = Request::create('/oauth/token', 'post', $data);

        $tokenResponse = app()->handle($tokenRequest);
        $contentString = $tokenResponse->content();
        $tokenContent = json_decode($contentString, true);

        if(!empty($tokenContent['access_token'])){
            return $tokenResponse;
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ]);
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json(['success'=> false,'message' => $validator->errors()], 400);
        }


        $user = User::create([
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> Hash::make($request->get('password'))
        ]);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Registration Failed'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Registration Succeeded']);
    }
}
