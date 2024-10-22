<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{


    public function index()
    {
        // Fetch all permissions
        $permissions = Permission::all();

        // Return the view with the list of permissions
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        // Return the view for creating a new permission
        return view('permissions.create');
    }

    /**
     * Store a newly created permission in the database.
     */
  

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
            'guard_name' => 'required'
        ]);
    
        Permission::create(['name' => $request->name, 'guard_name' => $request->guard_name]);
    
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }
    /**
     * Show the form for editing the specified permission.
     */
    public function edit($id)
    {
        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Return the view for editing the permission
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'guard_name' => 'required'
        ]);

        // Find the permission by ID and update it
        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        // Redirect back with success message
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission from the database.
     */
    public function destroy($id)
    {
        // Find the permission by ID and delete it
        $permission = Permission::findOrFail($id);
        $permission->delete();

        // Redirect back with success message
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
  
}
