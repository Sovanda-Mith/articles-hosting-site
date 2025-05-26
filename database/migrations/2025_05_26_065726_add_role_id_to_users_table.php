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
            // Add foreign key constraint to existing role_id column
            if (!$this->foreignKeyExists('users', 'users_role_id_foreign')) {
                $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('restrict');
            }

            // Remove is_admin column if it exists
            if (Schema::hasColumn('users', 'is_admin')) {
                $table->dropColumn('is_admin');
            }
        });
    }

    /**
     * Check if foreign key exists
     */
    private function foreignKeyExists($table, $foreignKey)
    {
        $foreignKeys = \DB::select('SHOW CREATE TABLE ' . $table);
        $createTableStatement = $foreignKeys[0]->{'Create Table'};
        return strpos($createTableStatement, $foreignKey) !== false;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key and role_id column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            // Add back is_admin column
            $table->boolean('is_admin')->default(false);
        });
    }
};
