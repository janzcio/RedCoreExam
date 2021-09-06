<?php

namespace App\Services\Auth;

use App\Models\Role;
use App\Models\User;
use App\Services\Users\GetUserByEmail;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    private $getUserByEmail;

    public function __construct(GetUserByEmail $getUserByEmail)
    {
        $this->getUserByEmail = $getUserByEmail;
    }
    /**
     * Create User
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function execute($request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $user = null;
        if (Auth::attempt($credentials)) {
            $user = $this->getUserByEmail->execute($request->email);
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Unauthorized';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
            'user_details' => !is_null($user) ? [
                "full_name" => $user->full_name,
                "email" => $user->email
            ] : [],
        ];
        return $response;
    }
}
