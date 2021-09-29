<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\UserCollection;
use App\Http\Requests\ChangeDetailsRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Actions\User\UpdateUserDetailsAction;
use App\Actions\User\UpdateUserPasswordAction;

class UsersController extends Controller
{

    public function index()
    {
        if (Gate::allows('view-technical-dashboard')) {
/*              $user =  User::findOrFail(Auth::id());
             $userRoles = $user->roles()->with('permissions')->get();
             $roles = $userRoles->pluck('slug');
             $rolesPermissions = $userRoles->pluck('permissions')->flatten(1)->pluck('slug');
             $userPermissions = $rolesPermissions->merge($user->permissions->pluck('slug'));
             $user->roles()->toggle(Role::where('slug', 'admin')->first());

            return response()->json([
                'user' => $user,
                'roles' => $roles,
                'userRole' => $userRoles,
                'userPermissions' => $userPermissions
            ]); */
            return new UserCollection(User::all()->keyBy->id);
        }
    }

    public function me()
    {
        if (Gate::allows('view-technical-dashboard')) {
            return new UserResource(Auth::user());
        }
    }

    public function changePassword(ChangePasswordRequest $request, UpdateUserPasswordAction $updateUserPasswordAction) {

        if ($updateUserPasswordAction->run($request->all(), Auth::id())) {
            return response()->json(["success" => true]);
        }

        return response()->json(["success" => false]);
    }

    public function changeDetails(ChangeDetailsRequest $request, UpdateUserDetailsAction $updateUserDetailsAction) {

        if ($updateUserDetailsAction->run($request->all(), Auth::id())) {
            return response()->json(["success" => true]);

        }
        return response()->json(["success" => false]);
    }
}
