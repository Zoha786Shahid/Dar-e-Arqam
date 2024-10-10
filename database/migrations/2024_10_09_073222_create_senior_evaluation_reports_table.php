<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('senior_evaluation_reports', function (Blueprint $table) {
            $table->id();
    $table->foreignId('teacher_id')->constrained()->onDelete('cascade');  // Reference to teachers table
    $table->foreignId('campus_id')->constrained()->onDelete('cascade');   // Reference to campuses table
    
    // Marks fields (0-10)
    $table->unsignedTinyInteger('entrance_welcome_marks')->nullable();
    $table->unsignedTinyInteger('appearance_dress_code_marks')->nullable();
    $table->unsignedTinyInteger('seating_cleanliness_marks')->nullable();
    $table->unsignedTinyInteger('writing_board_prep_marks')->nullable();
    $table->unsignedTinyInteger('writing_board_use_marks')->nullable();
    $table->unsignedTinyInteger('syllabus_division_marks')->nullable();
    $table->unsignedTinyInteger('assessment_start_marks')->nullable();
    $table->unsignedTinyInteger('pk_testing_marks')->nullable();
    $table->unsignedTinyInteger('av_activities_marks')->nullable();
    $table->unsignedTinyInteger('teaching_methods_marks')->nullable();
    $table->unsignedTinyInteger('subject_command_marks')->nullable();
    $table->unsignedTinyInteger('student_clarity_marks')->nullable();
    $table->unsignedTinyInteger('student_involvement_marks')->nullable();
    $table->unsignedTinyInteger('individual_attention_marks')->nullable();
    $table->unsignedTinyInteger('copy_work_marks')->nullable();
    $table->unsignedTinyInteger('moral_training_marks')->nullable();
    $table->unsignedTinyInteger('reading_marking_objective_marks')->nullable();
    $table->unsignedTinyInteger('lecture_planning_marks')->nullable();
    $table->unsignedTinyInteger('time_management_marks')->nullable();
    $table->unsignedTinyInteger('spoken_english_marks')->nullable();
    $table->unsignedTinyInteger('evaluation_marks')->nullable();
    $table->unsignedTinyInteger('home_task_checking_marks')->nullable();
    $table->unsignedTinyInteger('class_discipline_marks')->nullable();
    $table->integer('total_marks');
    // Observer's guidance and teacher's views
    $table->text('observer_guidance')->nullable()->nullable();
    $table->text('teacher_views')->nullable()->nullable();

    // Observer name field
    $table->string('observer_name')->nullable();

    // Timestamps
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senior_evaluation_reports');
    }
};
