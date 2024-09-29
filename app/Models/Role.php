<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'guard_name'];
    
     // Define the relationship with permissions (if using a many-to-many relationship)
     public function permissions()
     {
         return $this->belongsToMany(Permission::class, 'permission_role'); // Specify the pivot table
     }
     
     
}
