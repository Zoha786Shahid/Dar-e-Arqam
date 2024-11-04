<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'class_id'];
    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }
    // Example relationship with Subject
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'section_subject_teacher')->withPivot('teacher_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section_subject')->withPivot('section_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section_subject')->withPivot('teacher_id');
    }
    public function teacherSubjectsClasses()
{
    return $this->belongsToMany(Teacher::class, 'teacher_section_subject')
                ->withPivot('class_id', 'subject_id')
                ->withTimestamps();
}

}
