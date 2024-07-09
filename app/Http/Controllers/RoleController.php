<?php

namespace App\Http\Controllers;

use App\Http\Requests\SotreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('admin.Dynamic.role');
    }


    public function fetch()
    {
        $Roles = Role::all();
        return response()->json(['Roles' => $Roles]);
    }

  


    public function store(SotreRoleRequest $request)
    {
        //Make the validation request on the Request file in rules function 
        $validated= $request->validated();

        $role = Role::create($validated);    

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role,
        ]);
    }

  


    public function edit(Role $role)
    {
        return response()->json(['role' => $role]);
    }

    public function update(UpdateRoleRequest $request,Role $role)
    {
        
        $validated = $request->validated();

        $role->update($validated);

        return response()->json([
            'message' => 'Role updated successfully',
        ]);
    }


    public function destroy(Role $role)
    {
        $id = $role->id;
        $role->delete();
        return response()->json([ 'tr' => 'tr_' . $id ,'message'=>'Role deleted successfully']);
    }
}
