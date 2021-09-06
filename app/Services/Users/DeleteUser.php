<?php

namespace App\Services\Users;

use App\Models\User;

class DeleteUser
{
    /**
     * GetUserById
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function execute($id)
    {
        $user = User::find($id);
        return $user->delete();
    }
}
