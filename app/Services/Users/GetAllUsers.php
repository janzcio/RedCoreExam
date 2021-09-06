<?php

namespace App\Services\Users;

use App\Models\User;

class GetAllUsers
{
    /**
     * Get all Users
     * @return [type] [description]
     */
    public function execute()
    {
        $users = User::all()->toArray();
        return array_reverse($users);
    }
}
