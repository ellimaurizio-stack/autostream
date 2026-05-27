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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_drive_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('driving_rating');
            $table->tinyInteger('comfort_rating');
            $table->text('positive_feedback')->nullable();
            $table->text('negative_feedback')->nullable();
            $table->boolean('privacy_consent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
