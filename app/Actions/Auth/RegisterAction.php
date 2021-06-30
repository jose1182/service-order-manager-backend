<?php

namespace App\Actions\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAction{
    public function run($request){

        $userRole =  Role::user()->first();

        $user = User::create([
            'name'=> $request['name'],
            'email'=> $request['email'],
            'password'=> Hash::make($request['password'])
        ]);

        $user->roles()->attach($userRole->id);

        return $user;
    }
}
