<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\Roles\CreateRole;
use App\Services\Roles\DeleteRole;
use App\Services\Roles\GetAllRoles;
use App\Services\Roles\GetRoleById;
use App\Services\Roles\UpdateRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class RoleController extends Controller
{
    // all role
    public function index(GetAllRoles $getAllRoles)
    {
        return $getAllRoles->execute();
    }

    // add role
    public function add(Request $request, CreateRole $createRole)
    {
        $response = $createRole->execute($request->all());

        return response()->json('The Role successfully added');
    }

    // edit role
    public function edit($id, GetRoleById $getRoleById)
    {
        $response = $getRoleById->execute($id);
        return response()->json($response);
    }

    // update role
    public function update($id, Request $request, UpdateRole $updateRole)
    {
        $response = $updateRole->execute($id, $request);

        return response()->json('The Role successfully updated');
    }

    // delete role
    public function delete($id, DeleteRole $deleteRole)
    {
        $response = $deleteRole->execute($id);

        return response()->json('The Role successfully deleted');
    }
}