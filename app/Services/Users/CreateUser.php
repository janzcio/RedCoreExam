<?php

namespace App\Services\Users;

use App\Models\Role;
use App\Models\User;

class CreateUser
{
    /**
     * Create User
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function execute($param)
    {
        $param["password"] = bcrypt($param["password"]);
        $userCreate =  User::create($param);

        if ($userCreate && isset($param["role"]) ) {
            $userCreate->assignRole((int)$param["role"]);
        }

        return $userCreate;
    }
}
