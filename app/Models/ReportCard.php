<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'campus_id',
        'entrance_welcome',
        'appearance_dress',
        'teaching_style',
        'safety_cleanliness',
        'discipline',
        'class_board',
        'teaching_plan',
        'student_preparation',
        'conversation_standard',
        'hifz_during_teaching',
        'hifz_fluency',
        'recitation',
        'moral_training',
        'intellectual_moral_training',
        'physical_strength_health',
        'time_management',
        'student_performance',
        'diary',
        'total_marks',
    ];
  
    public function teacher()
    {
        return $this->belongsTo(Teacher::class); // Adjust 'Teacher' to the correct model namespace if necessary
    }

    // Define the relationship to the Campus model
    public function campus()
    {
        return $this->belongsTo(Campus::class); // Adjust 'Campus' to the correct model namespace if necessary
    }


}
