<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private function validateUser(Request $request, $isUpdate = false, $userId = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => $isUpdate
                ? 'required|string|email|max:255|unique:users,email,' . $userId
                : 'required|string|email|max:255|unique:users',
            'password' => $isUpdate
                ? 'nullable|string|min:8|confirmed'
                : 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'nullable|exists:roles,id',
            'campus_id' => 'required|exists:campuses,id',
        ]);
    }

    private function handleAvatarUpload(Request $request, $oldAvatar = null)
    {
        if ($request->hasFile('avatar')) {
            if ($oldAvatar) {
                $oldAvatarPath = public_path('images/' . $oldAvatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Remove the old avatar
                }
            }

            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('images'), $avatarName);
            return $avatarName;
        }

        return $oldAvatar; // Retain the old avatar if no new file is provided
    }

    private function assignOrSyncRole(User $user, $roleId)
    {
        if ($roleId) {
            $role = Role::find($roleId);
            if ($role) {
                $user->syncRoles($role->name);
            }
        }
    }

    public function index()
    {
        $campus = Campus::all();
        $users = User::with('roles')->get();
        return view('user.index', compact('users', 'campus'));
    }

    public function create()
    {
        $campuses = Campus::all();
        $roles = Role::all();
        return view('user.create', compact('roles', 'campuses'));
    }

    public function store(Request $request)
    {
        $data = $this->validateUser($request);
        $data['password'] = Hash::make($data['password']);
        $data['avatar'] = $this->handleAvatarUpload($request);

        $user = User::create($data);

        $this->assignOrSyncRole($user, $request->role_id);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $campuses = Campus::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        $permissions = $user->roles->flatMap->permissions;

        return view('user.edit', compact('user', 'roles', 'userRoles', 'permissions', 'campuses'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validateUser($request, true, $user->id);
        $data['password'] = $data['password'] ? Hash::make($data['password']) : $user->password;
        $data['avatar'] = $this->handleAvatarUpload($request, $user->avatar);

        $user->update($data);

        $this->assignOrSyncRole($user, $request->role_id);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            $avatarPath = public_path('images/' . $user->avatar);
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
