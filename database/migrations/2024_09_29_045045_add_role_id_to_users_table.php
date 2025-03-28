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
                $table->dropForeign(['role_id']); // Drops foreign key
                $table->dropColumn('role_id'); // Drops the column itself
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Recreate the 'role_id' column and foreign key constraint if you need to rollback
            $table->foreignId('role_id')->nullable()->constrained('roles')->after('id');
        });
    }
};
