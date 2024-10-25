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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('campus_id')->nullable()->after('email');

            // Optionally, add a foreign key constraint if you want to enforce referential integrity
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['campus_id']);
            
            // Then drop the campus_id column
            $table->dropColumn('campus_id');
        });
    }
};
