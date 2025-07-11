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
        Schema::create('ccms', function (Blueprint $table) {
            $table->id();

            // Request Information
            $table->string('request_no')->nullable();
            $table->date('logging_date')->nullable();
            $table->string('initiator')->nullable();
            $table->string('department')->nullable();
            $table->text('description')->nullable();
            $table->text('justification')->nullable();
            $table->string('area')->nullable();
            $table->string('impact')->nullable();

            // Actions and Priority
            $table->string('action1')->nullable();
            $table->string('action2')->nullable();
            $table->string('action3')->nullable();
            $table->string('priority');
            $table->date('required_date')->nullable();

            // Effected Documents
            $table->string('effected_doc1')->nullable();
            $table->string('doc_no1')->nullable();
            $table->string('effected_doc2')->nullable();
            $table->string('doc_no2')->nullable();
            $table->string('effected_doc3')->nullable();
            $table->string('doc_no3')->nullable();

            // Initiator Information
            $table->string('initiator_name')->nullable();
            $table->string('initiator_department')->nullable();
            $table->string('initiator_designation')->nullable();
            $table->timestamp('initiator_signtime')->nullable();

            // Verifier Information
            $table->string('verifier_name')->nullable();
            $table->string('verifier_department')->nullable();
            $table->string('verifier_designation')->nullable();
            $table->timestamp('verifier_signtime')->nullable();

            // Classification
            $table->string('classification')->nullable();

            // Reviewer Information
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

            // Approver Information
            $table->string('approver_name')->nullable();
            $table->string('approver_department')->nullable();
            $table->string('approver_designation')->nullable();
            $table->timestamp('approver_signtime')->nullable();

            // Task Information
            $table->string('task1')->nullable();
            $table->string('responsible1')->nullable();
            $table->date('completion_date1')->nullable();

            $table->string('task2')->nullable();
            $table->string('responsible2')->nullable();
            $table->date('completion_date2')->nullable();

            $table->string('task3')->nullable();
            $table->string('responsible3')->nullable();
            $table->date('completion_date3')->nullable();

            // Summary and Final Assessment
            $table->text('summary')->nullable();
            $table->date('implementation_date')->nullable();
            $table->text('final_assessment')->nullable();
            $table->text('monitoring')->nullable();

            // Closer Information
            $table->string('closer_name')->nullable();
            $table->string('closer_department')->nullable();
            $table->string('closer_designation')->nullable();
            $table->timestamp('closer_signtime')->nullable();

            $table->timestamps(); // Automatically manages created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changes');
    }
};
