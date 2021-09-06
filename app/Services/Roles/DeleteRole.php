<?php

namespace App\Services\Roles;

use App\Models\Role;

class DeleteRole
{
    /**
     * GetRoleById
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function execute($id)
    {
        $role = Role::find($id);
        return $role->delete();
    }
}
