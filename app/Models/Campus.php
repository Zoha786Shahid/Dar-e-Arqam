<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone_number',
        'email',
        'website',
        'principal_name',
        'principal_email',
        'principal_phone',
        'capacity',
        'status',
        'description',
        'created_at',
        'updated_at',
    ];
 // Optional: Define relationship: Campus has many Teachers
 public function teachers()
 {
     return $this->hasMany(Teacher::class);
 }
 public function users()
{
    return $this->hasMany(User::class);
}

}
