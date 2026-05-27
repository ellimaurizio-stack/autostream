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
        Schema::create('custom_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealership_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('key');
            $table->text('value');
            $table->string('locale')->default('it');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_labels');
    }
};
