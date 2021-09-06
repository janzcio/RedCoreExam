<?php

namespace App\Services\Users;

use App\Models\User;

class GetUserById
{
    /**
     * GetUserById
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function execute($id)
    {
        $users = User::find($id);
        return $users;
    }
}
