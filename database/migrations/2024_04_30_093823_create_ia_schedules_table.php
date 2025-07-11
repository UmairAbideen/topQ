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
        Schema::create('ia_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('internal_auditor1')->nullable();
            $table->string('internal_auditor2')->nullable();
            $table->date('doc_date')->nullable();

            $table->string('department1')->nullable();
            $table->date('date_dep1')->nullable();
            $table->string('time1')->nullable();
            $table->string('area1')->nullable();
            $table->string('auditee1a')->nullable();
            $table->string('auditee1b')->nullable();
            $table->string('auditee1c')->nullable();

            $table->string('department2')->nullable();
            $table->date('date_dep2')->nullable();
            $table->string('time2')->nullable();
            $table->string('area2')->nullable();
            $table->string('auditee2a')->nullable();
            $table->string('auditee2b')->nullable();
            $table->string('auditee2c')->nullable();

            $table->string('department3')->nullable();
            $table->date('date_dep3')->nullable();
            $table->string('time3')->nullable();
            $table->string('area3')->nullable();
            $table->string('auditee3a')->nullable();
            $table->string('auditee3b')->nullable();
            $table->string('auditee3c')->nullable();

            $table->string('prepared_by')->nullable();
            $table->string('preparator_designation')->nullable();
            $table->dateTime('preparation_time')->nullable();

            $table->string('approved_by')->nullable();
            $table->string('approver_designation')->nullable();
            $table->dateTime('approval_time')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ia_schedules');
    }
};
