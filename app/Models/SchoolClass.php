<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $table = 'classes'; // Specify the table name

    protected $fillable = [
        'name',
    ];

    // Relationship with Section model
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function teacherSectionsSubjects()
{
    return $this->belongsToMany(Teacher::class, 'teacher_section_subject')
                ->withPivot('section_id', 'subject_id')
                ->withTimestamps();
}

}
