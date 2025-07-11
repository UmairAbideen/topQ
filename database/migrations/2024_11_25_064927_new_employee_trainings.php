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
        Schema::create('new_employee_trainings', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->string('attendee_name')->nullable(); // Attendee name
            $table->string('attendee_department')->nullable(); // Attendee department
            $table->string('attendee_designation')->nullable(); // Attendee designation

            $table->date('joining_date')->nullable(); // Joining date

            $table->string('trainer_name')->nullable(); // Trainer name
            $table->string('trainer_department')->nullable(); // Trainer department

            // Dynamically add 20 training fields
            for ($i = 1; $i <= 20; $i++) {
                $table->string("training_name{$i}")->nullable(); // Training name
                $table->date("training_date{$i}")->nullable(); // Training date
            }

            $table->timestamps(); // Laravel's created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
