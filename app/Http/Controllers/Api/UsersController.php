<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\UpdateUserDetailsAction;
use App\Actions\User\UpdateUserPasswordAction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function me()
    {
        return new UserResource(Auth::user());
    }

    public function changePassword(Request $request, UpdateUserPasswordAction $updateUserPasswordAction) {

        if($updateUserPasswordAction->run($request->all(), Auth::id())){
            return response()->json(["Success" => true]);
        }

        return response()->json(["Success" => false]);

    }

    public function changeDetails(Request $request, UpdateUserDetailsAction $updateUserDetailsAction) {

        if($updateUserDetailsAction->run($request->all(), Auth::id())){
            return response()->json(["Success" => true]);
        }

        return response()->json(["Success" => false]);
    }
}
