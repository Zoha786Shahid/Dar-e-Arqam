<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
     protected $fillable = [
        
        'name',          // Class discipline
        'description',
    ];
    public function teachers()
{
    return $this->belongsToMany(Teacher::class, 'teacher_section_subject')->withPivot('section_id');
}

public function sections()
{
    return $this->belongsToMany(Section::class, 'teacher_section_subject')->withPivot('teacher_id');
}
public function teacherClassesSections()
{
    return $this->belongsToMany(Teacher::class, 'teacher_section_subject')
                ->withPivot('class_id', 'section_id')
                ->withTimestamps();
}

public function teacherSectionSubjects()
{
    return $this->hasMany(TeacherSectionSubject::class, 'subject_id');
}

}
