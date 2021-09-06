<?php

namespace App\Services\Roles;

use App\Models\Role;

class GetRoleById
{
    /**
     * GetRoleById
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function execute($id)
    {
        $roles = Role::find($id);
        return $roles;
    }
}
