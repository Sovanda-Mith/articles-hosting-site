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
            // Add username column if it doesn't exist
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('name');
            }

            // Add bio column if it doesn't exist
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable();
            }

            // Add profile image column if it doesn't exist
            if (!Schema::hasColumn('users', 'pf_image')) {
                $table->string('pf_image')->nullable();
            }

            // Add gender column if it doesn't exist
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female', 'prefer_not_to_say'])
                      ->default('prefer_not_to_say');
            }

            // Add admin flag if it doesn't exist
            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop columns in reverse order to avoid constraint issues
            $columnsToCheck = ['is_admin', 'gender', 'pf_image', 'bio', 'username'];

            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
