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
        Schema::create('report_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');  // Reference to teachers table
            $table->foreignId('campus_id')->constrained()->onDelete('cascade');   // Reference to campuses table        
            $table->integer('entrance_welcome')->unsigned();
            $table->integer('appearance_dress')->unsigned();
            $table->integer('teaching_style')->unsigned();
            $table->integer('safety_cleanliness')->unsigned();
            $table->integer('discipline')->unsigned();
            $table->integer('class_board')->unsigned();
            $table->integer('teaching_plan')->unsigned();
            $table->integer('student_preparation')->unsigned();
            $table->integer('conversation_standard')->unsigned();
            $table->integer('hifz_during_teaching')->unsigned();
            $table->integer('hifz_fluency')->unsigned();
            $table->integer('recitation')->unsigned();
            $table->integer('moral_training')->unsigned();
            $table->integer('intellectual_moral_training')->unsigned();
            $table->integer('physical_strength_health')->unsigned();
            $table->integer('time_management')->unsigned();
            $table->integer('student_performance')->unsigned();
            $table->integer('diary')->unsigned();
            $table->integer('total_marks')->unsigned()->nullable(); // total marks can be calculated and nullable

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_cards');
    }
};
