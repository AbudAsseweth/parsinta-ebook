<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function assign(Request $request, User $user)
    {
        $role = Role::find($request->role_id);
        abort_if(is_null($role), 403, "This role cannot be found");

        $roleAttached = $user->roles()->toggle($request->role_id);
        $status = $roleAttached['attached'] ? 'assigned' : 'removed';

        $msg = "Role \"{$role->name}\" for user \"{$user->name}\" has been {$status}";
        return to_route("users.index")->with("status", $msg);
    }
}
