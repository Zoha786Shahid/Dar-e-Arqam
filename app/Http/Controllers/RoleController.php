<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission; 
class RoleController extends Controller
{
     // Display a listing of the roles
     public function index()
     {
         $roles = Role::all();
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
             'name' => 'required',
             'guard_name' => 'required'
         ]);
 
         Role::create($request->all());
 
         return redirect()->route('roles.index')->with('success', 'Role created successfully.');
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
}
