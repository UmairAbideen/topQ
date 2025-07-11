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
        Schema::create('change_requests', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->string('change_no')->nullable();
            $table->string('department')->nullable();
            $table->string('doc_no')->nullable();
            $table->string('doc_name')->nullable();

            for ($i = 1; $i <= 5; $i++) {
                $table->string("change{$i}")->nullable();
                $table->string("reason{$i}")->nullable();
            }
            $table->string('impact')->nullable();

            // Verifier Information
            $table->string('verifier_name')->nullable();
            $table->string('verifier_department')->nullable();
            $table->string('verifier_designation')->nullable();
            $table->timestamp('verifier_signtime')->nullable();

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
