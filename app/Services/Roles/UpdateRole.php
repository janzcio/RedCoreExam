<?php

namespace App\Services\Roles;

use App\Models\Role;

class UpdateRole
{
    /**
     * Update Role
     * @param  [type] $id  [description]
     * @param  [type] $req [description]
     * @return [type]      [description]
     */
    public function execute($id, $req)
    {
        $role = Role::find($id);
        $role->update($req->all());
    }
}
