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
        Schema::create('number_issuances', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->string('department')->nullable();
            $table->string('doc_no')->nullable();
            $table->string('doc_name')->nullable();
            $table->string('reason')->nullable();

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

            $table->timestamps();
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
