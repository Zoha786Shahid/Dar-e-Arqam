<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        // Fetch all users and eager load their roles
        $users = User::with('roles')->get(); // Eager load roles (note it's 'roles', not 'role')
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Return the create user view
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        // Handle the avatar upload if provided
        $avatarName = null; // Initialize the avatar name variable
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->file('avatar')->extension(); // Generate a unique filename
            $request->file('avatar')->move(public_path('images'), $avatarName); // Move file to public/images
        }

        // Create and store the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarName, // Store the avatar filename in the database
        ]);

        // Assign the role to the user if role_id is provided
        if ($request->role_id) {
            // Check if the role exists
            $role = Role::find($request->role_id);

            if (!$role) {
                return redirect()->back()->with('error', 'Invalid role selected.');
            }


            // Assign the role to the user
            $user->assignRole($role->name);
        }
        // dd($role->name);
        // Redirect to user list after successful creation
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }



    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray(); // Get the user's assigned roles
        $permissions = $user->roles->flatMap->permissions; // Get all permissions from the roles

        return view('user.edit', compact('user', 'roles', 'userRoles', 'permissions'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // allowing image files
            'role_id' => 'nullable|exists:roles,id',
        ]);

        // Handle the avatar upload if a new file is provided
        if ($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($user->avatar) {
                $oldAvatarPath = public_path('images/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Remove the old file
                }
            }

            // Generate a new unique filename
            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('images'), $avatarName); // Move file to public/images
        } else {
            $avatarName = $user->avatar; // Retain the old avatar if no new file is provided
        }

        // Update user fields
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'avatar' => $avatarName, // Store the updated or old avatar filename
            'role_id' => $request->role_id,
        ]);
        // Sync role to user
        if ($request->role_id) {
            $role = Role::find($request->role_id);
            $user->syncRoles($role->name); // Sync roles using the role name
        }

        // Redirect to user list after successful update
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back to user list
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
