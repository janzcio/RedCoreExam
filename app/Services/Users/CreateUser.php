<?php

namespace App\Services\Users;

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
        return User::create($param);
    }
}
