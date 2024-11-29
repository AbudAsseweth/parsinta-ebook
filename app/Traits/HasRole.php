<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRole
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function hasRole($role)
    {
        return $this->roles->pluck('name')->contains($role);
    }

    public function hasAnyRoles(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->pluck('name')->contains($role)) {
                return true;
            }
        }

        return false;
    }
}
