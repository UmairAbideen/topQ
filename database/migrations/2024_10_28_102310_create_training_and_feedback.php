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
        Schema::create('training_and_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('training_name')->nullable();
            $table->string('location')->nullable();
            $table->date('date')->nullable();
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->string('department')->nullable();

            // Trainer Information
            $table->string('trainer_name')->nullable();
            $table->string('trainer_department')->nullable();
            $table->string('trainer_designation')->nullable();
            $table->timestamp('trainer_signtime')->nullable();

            for ($i = 1; $i <= 60; $i++) {
                $table->text("attendee_name{$i}")->nullable(); // Change to TEXT
                $table->text("absence{$i}")->nullable(); // Change to TEXT
                $table->text("attendee_department{$i}")->nullable(); // Change to TEXT
                $table->text("attendee_designation{$i}")->nullable(); // Change to TEXT
                $table->timestamp("attendee_signtime{$i}")->nullable();
            }

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_trainings');
    }
};
