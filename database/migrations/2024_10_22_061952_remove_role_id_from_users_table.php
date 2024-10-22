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
            // Drop foreign key constraint if it exists
            if (Schema::hasColumn('users', 'role_id')) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id'); // Drop the role_id column
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Re-add the role_id column if you rollback the migration
            $table->foreignId('role_id')->nullable()->constrained('roles');
        });
    }
};
