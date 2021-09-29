<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SwitchRoleController extends Controller
{
    public function switchRole(Request $request)
    {
        try
        {
            $user = User::findOrFail($request->id);
            return $user->roles()->toggle(Role::where('slug', 'admin')->first());
        }
        // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            return response()->json([
                "message" => 'User not found!',
                "success" => false
            ], 400);
        }
    }
}
