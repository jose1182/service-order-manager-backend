<?php

namespace App\Traits;

use App\Models\Permission;
use PhpParser\Builder\Trait_;

trait HasPermissions {
    public function hasPermissionTo(...$permissions){
        //$user->hasPermissionTo('edit-user', 'edit-issue);
        return $this->permissions()->whereIn('slug', $permissions)->count() || $this->roles()->whereHas('permissions', function($q) use($permissions){
            $q->whereHas('slug', $permissions);
        })-> count();
    }

    public function getPermissionIdsBySlug($permissions){
        return Permission::where('slug', $permissions)->get()->pluck('id')->toArray();
    }

    public function givePermissionsTo(...$permissions) {

        $this->permissions()->attach($this->getPermissionIdsBySlug($permissions));
    }

    public function setPermissionsTo(...$permissions) {
        $this->permissions()->sync($this->getPermissionIdsBySlug($permissions));
    }

    public function detachPermissions(...$permissions){
        $this->permissions()->detach($this->getPermissionIdsBySlug($permissions));
    }

}
