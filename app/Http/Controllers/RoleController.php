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
        $roles = Role::with('permissions')->get();

        // Loop through roles and auto-assign all permissions to Owner
        foreach ($roles as $role) {
            if ($role->name === 'Owner') {
                // Automatically assign all available permissions to the Owner role if not already assigned
                $allPermissions = Permission::all();
                $role->syncPermissions($allPermissions);
            }
        }

        return view('roles.index', compact('roles'));
    }


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
            'guard_name' => 'required',
            'permissions' => 'array', // Ensure permissions are passed as an array
        ]);

        // Create the role
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        // Fetch permissions by their IDs
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();

            if ($permissions->isEmpty()) {
                return redirect()->back()->withErrors(['permissions' => 'No matching permissions found.']);
            }

            // Sync permissions with the role
            $role->permissions()->sync($permissions->pluck('id')->toArray());
        }

        // Redirect to /roles with a success message
        return redirect('/roles')->with('success', 'Role created successfully with permissions.');
    }



    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // Or any logic you use to fetch permissions

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id, // Allow the current role's name
            'guard_name' => 'required',
            'permissions' => 'array', // Ensure permissions are passed as an array
        ]);

        // Update the role
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        // Fetch permissions by their IDs and sync
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();

            if ($permissions->isEmpty()) {
                return redirect()->back()->withErrors(['permissions' => 'No matching permissions found.']);
            }

            // Sync permissions with the role
            $role->permissions()->sync($permissions->pluck('id')->toArray());
        }

        // Redirect to /roles with a success message
        return redirect('/roles')->with('success', 'Role updated successfully with permissions.');
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
    //  public function assignPermissions(Request $request)
    //  {
    //      $request->validate([
    //          'role_name' => 'required|exists:roles,name',
    //          'permissions' => 'required|array',
    //          'permissions.*' => 'exists:permissions,name',
    //      ]);

    //      // Find the role by name
    //      $role = Role::findByName($request->role_name);

    //      // Sync the selected permissions with the role
    //      $role->syncPermissions($request->permissions);
    //      return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully');

    //  }

    public function assignPermissions(Request $request)
    {
        // Fetch the role by name
        $role = Role::where('name', $request->input('role_name'))->firstOrFail();

        // Check if the selected role is "Owner"
        if ($role->name == 'Owner') {
            // Assign all permissions to the "Owner" role
            $allPermissions = Permission::all(); // Get all permissions
            $role->syncPermissions($allPermissions); // Sync all permissions to the "Owner" role
        } else {
            // For other roles, assign the selected permissions
            $selectedPermissions = $request->input('permissions', []);
            $role->syncPermissions($selectedPermissions); // Sync selected permissions for the role
        }

        return back()->with('success', 'Permissions assigned successfully!');
    }
    public function getRolePermissions($roleName)
    {
        // Fetch the role by name
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            // Get permissions already assigned to the role
            $assignedPermissions = $role->permissions->pluck('name');

            // Get all available permissions
            $allPermissions = Permission::pluck('name');

            // Return both arrays
            return response()->json([
                'assigned' => $assignedPermissions,
                'all' => $allPermissions
            ]);
        }

        return response()->json(['error' => 'Role not found'], 404);
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        // Revoke the permission from the role
        $role->revokePermissionTo($permission);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Permission revoked from role successfully.');
    }
}
