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
        Schema::create('weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_name_id')->constrained('class_names');
            $table->string('week_id'); // Week number
            $table->string('topic_covered')->nullable();
            $table->text('important_points')->nullable();
            $table->text('practical_implementation')->nullable();
            $table->text('week_summary')->nullable();
            $table->text('next_topic')->nullable();
            $table->text('next_session_prep')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
