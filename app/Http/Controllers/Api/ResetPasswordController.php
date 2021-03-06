<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{

    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "token" => "required",
            'password' => 'required|confirmed|min:8'
        ]);

        if($validator->fails()){
                return response()->json(['success'=> false,'message' => $validator->errors()], 400);
        }

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }


    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();
//        event(new PasswordReset($user));
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json([
            "message" => 'Password reset succeeded',
            "response" => $response
        ], 200);
    }


    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            "message" => 'Password reset failed',
            "response" => $response
        ], 500);
    }
}
