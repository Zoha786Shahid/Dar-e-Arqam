<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    // Display a listing of the roles
    public function index()
    {
        // Eager load permissions for roles
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    // Show the form for creating a new role
    // Make sure to import the Permission model

    public function create()
    {
        $permissions = Permission::all(); // Fetch all permissions
        return view('roles.create', compact('permissions')); // Pass the permissions to the view
    }

    // Store a newly created role in the database


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'guard_name' => 'required'
        ]);

        Role::create(['name' => $request->name, 'guard_name' => $request->guard_name]);

        return redirect()->back()->with('success', 'Role created successfully.');
    }

    // Display the specified role


    // Show the form for editing the specified role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // Or any logic you use to fetch permissions

        return view('roles.edit', compact('role', 'permissions'));
    }


    // Update the specified role in the database
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Remove the specified role from the database
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
     // Other Role-related methods...

     public function assignPermissionsForm()
     {
         // Fetch all roles and permissions
         $roles = Role::all();
         $permissions = Permission::all();
 
         // Return the view with roles and permissions
         return view('roles.assign_permissions', compact('roles', 'permissions'));
     }
     public function assignPermissions(Request $request)
     {
         $request->validate([
             'role_name' => 'required|exists:roles,name',
             'permissions' => 'required|array',
             'permissions.*' => 'exists:permissions,name',
         ]);
 
         // Find the role by name
         $role = Role::findByName($request->role_name);
 
         // Sync the selected permissions with the role
         $role->syncPermissions($request->permissions);
 
         return redirect()->back()->with('success', 'Permissions assigned successfully.');
     }
     public function revokePermission(Role $role, Permission $permission)
     {
         // Revoke the permission from the role
         $role->revokePermissionTo($permission);
 
         // Redirect back with a success message
         return redirect()->back()->with('success', 'Permission revoked from role successfully.');
     }
}
