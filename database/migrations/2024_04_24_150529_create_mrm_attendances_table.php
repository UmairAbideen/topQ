<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mrm_attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('mrm_agenda_id')->references('id')->on('mrm_agendas')
            ->onDelete('cascade')->onUpdate('cascade');

            // Repeat for 10 sets of department, designation, signature, and signature time
            for ($i = 1; $i <= 10; $i++) {
                $table->string("name$i")->nullable();
                $table->string("department$i")->nullable();
                $table->string("absence$i")->nullable();
                $table->string("designation$i")->nullable();
                $table->string("signature$i")->nullable();
                $table->dateTime("signature_time$i")->nullable();
            }

            $table->string('prepared_by')->nullable();
            $table->string('preparator_designation')->nullable();
            $table->dateTime('preparation_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrm_attendance');
    }
};
