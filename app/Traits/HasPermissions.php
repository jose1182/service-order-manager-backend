<?php

namespace App\Traits;

use App\Permission;
use PhpParser\Builder\Trait_;

trait HasPermissions {
    public function hasPermissionTo(...$permissions){
        //$user->hasPermissionTo('edit-user', 'edit-issue);
        return $this->permissions()->whereIn('slug', $permissions)->count() || $this->roles()->whereHas('permissions', function($q) use($permissions){
            $q->whereHas('slug', $permissions);
        })-> count();
    }

    public function givePermissionsTo(...$permissions) {
        $this->permissions()->attach($permissions);
    }

    public function setPermissionsTo(...$permissions) {
        $this->permissions()->sync($permissions);
    }

    public function detachPermissions(...$permissions){
        $this->permissions()->detach($permissions);
    }

}
