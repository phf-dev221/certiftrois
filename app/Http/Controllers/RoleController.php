<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles  = Role::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Liste des roles',
            'roles' => $roles
        ]);
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRoleRequest $request)
    {

        $role = new Role();
        $role->nomRole = $request->input('nomRole');
        $role->save();

        return response()->json($role);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json($role);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

        $role->update($request->only(['nomRole']));


        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(["message" => "role supprimé avec success"]);
    }
}