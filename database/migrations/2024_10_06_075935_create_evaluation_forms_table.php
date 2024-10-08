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
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('campus_id')->constrained()->onDelete('cascade');
            $table->integer('total_students');
            $table->integer('appearance_dress_code');
            $table->integer('lesson_plan');
            $table->integer('standard_of_lesson_plan');
            $table->integer('introduction_pk_testing');
            $table->integer('islamization');
            $table->integer('gesture_tone_body_language');
            $table->integer('communication_skill');
            $table->integer('strategies_activities');
            $table->integer('discipline_class_control');
            $table->integer('tools_av_aids');
            $table->integer('tools_illustrative_material');
            $table->integer('tools_writing_board');
            $table->integer('real_life_integration');
            $table->integer('competency_command_on_subject');
            $table->integer('time_management');
            $table->integer('evaluation_conclusion');
            $table->integer('diary_hw_checking');
            $table->integer('call_on_board');
            $table->integer('knowledge_gain');
            $table->integer('skill_gain_spoken');
            $table->integer('skill_gain_written');
            $table->integer('personality_trait_confidence');
            $table->integer('response_of_previous_knowledge');
            $table->integer('total_marks');
            $table->float('percentage');
            $table->string('observer_name');
            $table->string('observer_signature');
            $table->text('observer_guidance')->nullable();
            $table->text('teacher_views')->nullable();
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
