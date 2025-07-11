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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();

            $table->string('qre_no')->nullable();
            $table->date('receipt_date')->nullable();
            $table->string('department')->nullable();

            $table->string('area')->nullable();
            $table->string('description')->nullable();
            $table->string('existing_controls')->nullable();
            $table->string('coordinator')->nullable();

            $table->string('severity_before')->nullable();
            $table->string('probablity_before')->nullable();
            $table->string('detectability_before')->nullable();
            $table->string('rpn_before')->nullable();
            $table->string('criticality_before')->nullable();

            $table->string('action1')->nullable();
            $table->string('responsibility1')->nullable();
            $table->date('completion_date1')->nullable();

            $table->string('action2')->nullable();
            $table->string('responsibility2')->nullable();
            $table->date('completion_date2')->nullable();

            $table->string('action3')->nullable();
            $table->string('responsibility3')->nullable();
            $table->date('completion_date3')->nullable();

            $table->string('action4')->nullable();
            $table->string('responsibility4')->nullable();
            $table->date('completion_date4')->nullable();

            $table->string('action5')->nullable();
            $table->string('responsibility5')->nullable();
            $table->date('completion_date5')->nullable();

            $table->string('severity_after')->nullable();
            $table->string('probablity_after')->nullable();
            $table->string('detectability_after')->nullable();
            $table->string('rpn_after')->nullable();
            $table->string('criticality_after')->nullable();

            $table->string('verifier_name')->nullable();
            $table->string('verifier_department')->nullable();
            $table->string('verifier_designation')->nullable();
            $table->timestamp('verifier_signtime')->nullable();

            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_department')->nullable();
            $table->string('reviewer_designation')->nullable();
            $table->timestamp('reviewer_signtime')->nullable();

            $table->string('approver_name')->nullable();
            $table->string('approver_department')->nullable();
            $table->string('approver_designation')->nullable();
            $table->timestamp('approver_signtime')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk');
    }
};
