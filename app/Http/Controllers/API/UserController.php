<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Services\Users\CreateUser;
use App\Services\Users\DeleteUser;
use App\Services\Users\GetAllUsers;
use App\Services\Users\GetUserByEmail;
use App\Services\Users\GetUserById;
use App\Services\Users\UpdateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    // all User
    public function index(GetAllUsers $getAllUsers)
    {
        return $getAllUsers->execute();
    }

    // add User
    public function add(StoreUserRequest $request, CreateUser $createUser)
    {
        $response = $createUser->execute($request->all());

        return response()->json('The user successfully added');
    }

    // edit User
    public function edit($id, GetUserById $getUserById)
    {
        $response = $getUserById->execute($id);
        return response()->json($response);
    }

    // update User
    public function update($id, StoreUserRequest $request, UpdateUser $updateUser)
    {
        $response = $updateUser->execute($id, $request);

        return response()->json('The user successfully updated');
    }

    // delete User
    public function delete($id, DeleteUser $deleteUser)
    {
        $response = $deleteUser->execute($id);

        return response()->json('The user successfully deleted');
    }
    /**
     * Register
     */
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(UserLoginRequest $request, GetUserByEmail $getUserByEmail)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $user = null;
        if (Auth::attempt($credentials)) {
            
            $user = $getUserByEmail->execute($request->email);
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
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
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
        return response()->json($response);
    }
}