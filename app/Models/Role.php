<?php

namespace App\Models;

use App\Models\Permission;
use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasPermissions;

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function hasPermissionTo(...$permissions){
        //$role->hasPermissionTo('edit-user', 'edit-issue);
        return $this->permissions()->whereIn('slug', $permissions)->count();
    }
}
