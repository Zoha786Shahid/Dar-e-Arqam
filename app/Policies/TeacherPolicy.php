<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeacherPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // Owners can view any data without restrictions
        if ($user->hasRole('Owner')) {
            return true;
        }
    
        // Allow Principals to view teachers in their own campus
        if ($user->hasRole('Principal')) {
            return true;
        }
    
        // Allow Admins to view all teachers
        if ($user->hasRole('Admin')) {
            return true;
        }
    
        return false;
    }
    /**
     * Determine whether the user can view the model.
     */
   
    // public function view(User $user, Teacher $teacher)
    // {
    //     // Allow Admins to view all teachers
    //     if ($user->hasRole('Admin')) {
    //         return true;
    //     }
    
    //     // Allow Principals to view teachers in their own campus
    //     if ($user->hasRole('Principal') && $user->campus_id === $teacher->campus_id) {
    //         return true;
    //     }
    
    //     // Redirect with an error message instead of logging
    //     return redirect()->route('user.index')->with('error', 'Unauthorized access attempt.');
    // }
    public function view(User $user, Teacher $teacher)
{
    // Owners can view all data
    if ($user->hasRole('Owner')) {
        return true;
    }

    // Allow Principals to view teachers in their own campus
    if ($user->hasRole('Principal') && $user->campus_id === $teacher->campus_id) {
        return true;
    }

    // Allow Admins to view all teachers
    if ($user->hasRole('Admin')) {
        return true;
    }

    return redirect()->route('user.index')->with('error', 'Unauthorized access attempt.');
}
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only allow admins to create teachers
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(User $user, Teacher $teacher): bool
    // {
    //     // Allow administrators to update all teachers
    //     if ($user->hasRole('Admin')) {
    //         return true;
    //     }

    //     // Allow principals to update only teachers from their own campus
    //     if ($user->hasRole('Principal') && $user->campus_id === $teacher->campus_id) {
    //         return true;
    //     }

    //     return false; // Deny access otherwise
    // }
    public function update(User $user, Teacher $teacher)
    {
        // Allow Owners to edit any teacher
        if ($user->hasRole('Owner')) {
            return true;
        }
    
        // Add additional conditions for other roles (if any)
        // For example, only allow Principals to update teachers from their own campus
        if ($user->hasRole('Principal') && $user->campus_id === $teacher->campus_id) {
            return true;
        }
    
        // Deny access by default
        return false;
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Teacher $teacher): bool
    {
        // Only allow admins to delete teachers
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Teacher $teacher): bool
    {
        // Only allow admins to restore teachers
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Teacher $teacher): bool
    {
        // Only allow admins to force delete teachers
        return $user->hasRole('Admin');
    }
}