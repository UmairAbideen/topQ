<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('annual_training_plans', function (Blueprint $table) {
            $table->id();

            // Common fields
            $table->string('department')->nullable();
            $table->string('trainer_name')->nullable();

            // Add dynamic fields for training_name and month using a loop
            for ($i = 1; $i <= 20; $i++) {
                $table->string("training_name{$i}")->nullable();
                $table->string("month{$i}")->nullable();
            }

            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('_annual_training_plans');
    }
};
