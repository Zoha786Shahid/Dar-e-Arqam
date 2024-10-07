<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;
   
      // Specify the table if it does not follow Laravel's naming convention
      protected $table = 'evaluation_forms'; // Change to your actual table name
      // Allow mass assignment for these fields
      protected $fillable = [
          'teacher_name',
          'qualification',
          'joining_date',
          'class_section',
          'subject',
          'topic',
          'campus_id',
          'total_students',
          'date',
          'appearance_dress_code',
          'lesson_plan',
          'assessment',
          'observer_name',
          'observer_signature',
          'standard_of_lesson_plan',
          'introduction_pk_testing',
          'islamization',
          'gesture_tone_body_language',
          'communication_skill',
          'strategies_activities',
          'discipline_class_control',
          'tools_av_aids',
          'tools_illustrative_material',
          'tools_writing_board',
          'real_life_integration',
          'competency_command_on_subject',
          'time_management',
          'evaluation_conclusion',
          'diary_hw_checking',
          'class_participation',
          'call_on_board',
          'knowledge_gain',
          'skill_gain_spoken',
          'skill_gain_written',
          'personality_trait_confidence',
          'response_of_previous_knowledge',
          'total_marks',
          'percentage',
          'observer_guidance',
          'teacher_views',
          'teacher_signature',
      ];
      // In your Evaluation model (Evaluation.php)
public function campus()
{
    return $this->belongsTo(Campus::class, 'campus_id');
}

}
