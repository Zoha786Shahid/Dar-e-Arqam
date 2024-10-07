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
        Schema::create('evaluation_forms', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_name');
            $table->string('qualification');
            $table->date('joining_date');
            $table->string('class_section');
            $table->string('subject');
            $table->string('topic')->nullable(); // Assuming topic can be optional
            $table->foreignId('campus_id')->constrained()->onDelete('cascade');
            $table->integer('total_students');
            $table->date('date');
            $table->integer('appearance_dress_code'); // Change to integer
            $table->string('lesson_plan');
            $table->integer('standard_of_lesson_plan'); // Change to integer
            $table->string('assessment')->nullable(); // Assuming assessment can be optional
            $table->string('introduction_pk_testing'); // Change to integer zoha
            $table->integer('islamization'); // Change to integer
            $table->integer('gesture_tone_body_language'); // Change to integer
            $table->integer('communication_skill'); // Change to integer
            $table->integer('strategies_activities'); // Change to integer
            $table->integer('discipline_class_control'); // Change to integer
            $table->integer('tools_av_aids'); // Change to integer
            $table->integer('tools_illustrative_material'); // Change to integer
            $table->integer('tools_writing_board'); // Change to integer
            $table->integer('real_life_integration'); // Change to integer
            $table->integer('competency_command_on_subject'); // Change to integer
            $table->integer('time_management'); // Change to integer
            $table->integer('evaluation_conclusion'); // Change to integer
            $table->integer('diary_hw_checking'); // Change to integer
            $table->integer('class_participation'); // Change to integer
            $table->integer('call_on_board'); // Change to integer
            $table->integer('knowledge_gain'); // Change to integer
            $table->integer('skill_gain_spoken'); // Change to integer
            $table->integer('skill_gain_written'); // Change to integer
            $table->integer('personality_trait_confidence'); // Change to integer
            $table->integer('response_of_previous_knowledge'); // Change to integer
            $table->integer('total_marks');
            $table->float('percentage'); // Correct as float
            $table->string('observer_name');
            $table->string('observer_signature');
            $table->text('observer_guidance')->nullable();
            $table->text('teacher_views')->nullable();
            $table->string('teacher_signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_forms');
    }
};
