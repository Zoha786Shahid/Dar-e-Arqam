<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorEvaluationReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'campus_id',
        'class_id',
        'section_id',
        'subject_id',
        'observer_name',
        'observer_guidance',
        'teacher_views',



        'entrance_welcome_marks',           // Entrance (Salam/Welcome)
        'appearance_dress_code_marks',   // Appearance (Dress Code)
        'seating_cleanliness_marks',        // Seating Arrangement & Cleanliness
        'writing_board_prep_marks',         // Writing board preparation & sketching
        'writing_board_use_marks',          // Use of writing board & teachers writing
        'syllabus_division_marks',          // Day-wise division of syllabus
        'assessment_start_marks',           // Assessment (at the start)
        'pk_testing_marks',                 // P.K testing
        'av_activities_marks',              // Use of A.V Aids/Activities
        'teaching_methods_marks',           // Teaching strategies/techniques/methods
        'subject_command_marks',            // Command on subject
        'student_clarity_marks',            // Concept clarity of students
        'student_involvement_marks',        // Involvement of students
        'individual_attention_marks',       // Individual attention
        'copy_work_marks',                  // Copy work
        'moral_training_marks',             // Islamization/Moral training
        'reading_marking_objective_marks',  // Reading & marking of objective
        'lecture_planning_marks',           // Lecture delivery and planning relationship
        'time_management_marks',            // Time management
        'spoken_english_marks',             // Spoken English
        'evaluation_marks',                 // Evaluation
        'home_task_checking_marks',         // Home task / Prayers checking
        'class_discipline_marks',          // Class discipline
        // next 
        'total_marks',


    ];
    // Define the relationship to the Teacher model
 public function campus()
 {
     return $this->belongsTo(Campus::class, 'campus_id');
 }

 public function teacher()
 {
     return $this->belongsTo(Teacher::class, 'teacher_id');
 }

 public function schoolClass()
 {
     return $this->belongsTo(SchoolClass::class, 'class_id');
 }

 public function section()
 {
     return $this->belongsTo(Section::class, 'section_id');
 }

 public function subject()
 {
     return $this->belongsTo(Subject::class, 'subject_id');
 }

}
