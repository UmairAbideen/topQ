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
        Schema::create('deviations', function (Blueprint $table) {
            $table->id();

            // Initial Information
            $table->date('deviation_date')->nullable();
            $table->string('deviation_no')->nullable();
            $table->string('initiator_name')->nullable();
            $table->string('initiator_department')->nullable();
            $table->string('initiator_designation')->nullable();

            // Initial Assessment
            $table->string('subject')->nullable();
            $table->longtext('detail')->nullable();
            $table->string('status')->nullable();
            $table->string('statement')->nullable();
            $table->string('action')->nullable();

            // Verifier Information
            $table->string('verifier_name')->nullable();
            $table->string('verifier_department')->nullable();
            $table->string('verifier_designation')->nullable();
            $table->timestamp('verifier_signtime')->nullable();

            // Reviewer Information
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_department')->nullable();
            $table->string('reviewer_designation')->nullable();
            $table->timestamp('reviewer_signtime')->nullable();

            // Approver Information
            $table->string('approver_name')->nullable();
            $table->string('approver_department')->nullable();
            $table->string('approver_designation')->nullable();
            $table->timestamp('approver_signtime')->nullable();

            // Root Cause Analysis
            $table->longText('root_causes')->nullable();
            $table->string('root_cause_remarks')->nullable();

            // Categorization
            $table->string('categorization')->nullable();

            // Review Committee
            $table->string('reviewer_name1')->nullable();
            $table->string('reviewer_department1')->nullable();
            $table->string('reviewer_designation1')->nullable();
            $table->timestamp('reviewer_signtime1')->nullable();
            $table->string('recommendation1')->nullable();

            $table->string('reviewer_name2')->nullable();
            $table->string('reviewer_department2')->nullable();
            $table->string('reviewer_designation2')->nullable();
            $table->timestamp('reviewer_signtime2')->nullable();
            $table->string('recommendation2')->nullable();

            $table->string('reviewer_name3')->nullable();
            $table->string('reviewer_department3')->nullable();
            $table->string('reviewer_designation3')->nullable();
            $table->timestamp('reviewer_signtime3')->nullable();
            $table->string('recommendation3')->nullable();

            // Impact Evaluation By Manager
            $table->string('device_effected')->nullable();
            $table->string('patient_effecteds')->nullable();
            $table->string('other_effected')->nullable();

            // Manager Confirmation
            $table->string('confirmer_name')->nullable();
            $table->string('confirmer_department')->nullable();
            $table->string('confirmer_designation')->nullable();
            $table->timestamp('confirmer_signtime')->nullable();

            // Impact Evaluation By QA
            $table->string('required_recall')->nullable();
            $table->string('recall_no')->nullable();
            $table->string('required_capa')->nullable();
            $table->string('capa_no')->nullable();
            $table->string('required_ccm')->nullable();
            $table->string('ccm_no')->nullable();

            // Closer Information
            $table->string('closer_name')->nullable();
            $table->string('closer_department')->nullable();
            $table->string('closer_designation')->nullable();
            $table->timestamp('closer_signtime')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deviations');
    }
};
