<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'phone_number',
        'email',
        'address',
        // 'profile_picture',
        'employee_id',
        'hire_date',
        'class_id',
        // 'subjects',
        'qualification',
        'experience',
        'campus_id',
    ];
    // Define relationship: Teacher belongs to a Campus
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    // In Teacher.php model


    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section_subject')->withPivot('subject_id');
    }
    // In Teacher.php
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_section_subject', 'teacher_id', 'subject_id')->withPivot('section_id');
    }

    // In App\Models\Teacher.php
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id'); // assuming 'class_id' is the foreign key in the teachers table
    }


    public function sectionsSubjectsClasses()
    {
        return $this->belongsToMany(Subject::class, 'teacher_section_subject')
            ->withPivot('class_id', 'section_id')
            ->withTimestamps();
    }
    public function teacherSectionSubjects()
    {
        return $this->hasMany(TeacherSectionSubject::class, 'teacher_id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($teacher) {
            $teacher->teacherSectionSubjects()->delete();
        });
    }
}
