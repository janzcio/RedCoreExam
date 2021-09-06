<?php

namespace App\Services\Roles;

use App\Models\Role;

class CreateRole
{
    /**
     * Create Role
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function execute($param)
    {
        return Role::create($param);
    }
}
