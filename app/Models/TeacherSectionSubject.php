<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSectionSubject extends Model
{
    use HasFactory;
    protected $table = 'teacher_section_subject'; 
    protected $fillable = [
      
        'teacher_id',
        'class_id',
        'section_id',
        'subject_id',
    ];
}
