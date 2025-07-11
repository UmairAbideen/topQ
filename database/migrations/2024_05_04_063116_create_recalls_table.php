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
        Schema::create('recalls', function (Blueprint $table) {

            $table->id();

            $table->string('reporter_name')->nullable();
            $table->string('organization')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->date('receipt_date')->nullable();

            $table->string('product_name')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('batch')->nullable();
            $table->string('serial')->nullable();
            $table->string('expiry')->nullable();
            $table->string('manufacturing_date')->nullable();

            $table->string('qty_before')->nullable();
            $table->string('qty_distributed')->nullable();

            $table->string('customer_name1')->nullable();
            $table->date('distribution_date1')->nullable();

            $table->string('customer_name2')->nullable();
            $table->date('distribution_date2')->nullable();

            $table->string('customer_name3')->nullable();
            $table->date('distribution_date3')->nullable();

            $table->string('source')->nullable();
            $table->string('problem_detail')->nullable();
            $table->string('no_of_complaint')->nullable();
            $table->string('action_taken')->nullable();
            $table->string('risk_assessment')->nullable();
            $table->string('recall_type')->nullable();

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
        Schema::dropIfExists('recalls');
    }
};
