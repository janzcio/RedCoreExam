<?php

namespace App\Services\Users;

use App\Models\User;

class GetUserByEmail
{
    /**
     * [execute description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function execute($email)
    {
        $users = User::where('email',$email)->first();
        return $users;
    }
}
