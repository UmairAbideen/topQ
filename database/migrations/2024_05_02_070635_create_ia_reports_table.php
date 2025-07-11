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
        Schema::create('ia_reports', function (Blueprint $table) {
            $table->id();

            $table->string('report_no')->nullable();
            $table->date('doc_date')->nullable();

            $table->string('internal_auditor1')->nullable();
            $table->string('internal_auditor2')->nullable();

            $table->string('department1')->nullable();
            $table->date('date_dep1')->nullable();
            $table->string('area1')->nullable();
            $table->string('scope1')->nullable();

            $table->string('department2')->nullable();
            $table->date('date_dep2')->nullable();
            $table->string('area2')->nullable();
            $table->string('scope2')->nullable();

            $table->string('department3')->nullable();
            $table->date('date_dep3')->nullable();
            $table->string('area3')->nullable();
            $table->string('scope3')->nullable();

            $table->string('summary')->nullable();
            $table->string('deviation_no')->nullable();

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
        Schema::dropIfExists('ia_reports');
    }
};
