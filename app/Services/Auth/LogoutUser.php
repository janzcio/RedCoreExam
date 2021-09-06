<?php

namespace App\Services\Auth;

use App\Models\Role;
use App\Models\User;
use App\Services\Users\GetUserByEmail;
use Illuminate\Support\Facades\Auth;
use Session;

class LogoutUser
{
    public function execute()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return $response;
    }
}
