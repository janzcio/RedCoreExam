<?php

namespace App\Services\Roles;

use App\Models\Role;

class GetAllRoles
{
    /**
     * Get all Roles
     * @return [type] [description]
     */
    public function execute()
    {
        $roles = Role::all()->toArray();
        return array_reverse($roles);
    }
}
