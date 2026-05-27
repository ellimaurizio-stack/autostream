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
            $table->enum('role', ['SUPERADMIN', 'MANAGER'])->default('MANAGER')->after('password');
            $table->boolean('is_active')->default(false)->after('role');
            $table->foreignId('dealership_id')->nullable()->after('is_active')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dealership_id']);
            $table->dropColumn(['role', 'is_active', 'dealership_id']);
        });
    }
};
