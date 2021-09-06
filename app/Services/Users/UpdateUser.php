<?php

namespace App\Services\Users;

use App\Models\User;

class UpdateUser
{
    /**
     * Update User
     * @param  [type] $id  [description]
     * @param  [type] $req [description]
     * @return [type]      [description]
     */
    public function execute($id, $req)
    {
        $user = User::find($id);
        $data = $req->all();
        $data["password"] = bcrypt($data["password"]);
        $user->update($data);
    }
}
