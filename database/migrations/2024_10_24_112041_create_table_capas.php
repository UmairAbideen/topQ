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
        Schema::create('c_a_p_a_s', function (Blueprint $table) {

            $table->id();
            $table->string('capa_no')->nullable();
            $table->date('initiation_date')->nullable();
            $table->string('department')->nullable();

            // Details
            $table->string('source')->nullable();
            $table->text('description')->nullable();

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

            // Reviewer Information
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_department')->nullable();
            $table->string('reviewer_designation')->nullable();
            $table->timestamp('reviewer_signtime')->nullable();

            // Implementation (up to 10 actions)
            for ($i = 1; $i <= 10; $i++) {
                $table->string("action$i")->nullable();
                $table->string("responsible$i")->nullable();
                $table->date("due_date$i")->nullable();
                $table->date("implementation_date$i")->nullable();
            }

            // Approver Information
            $table->string('approver_name')->nullable();
            $table->string('approver_department')->nullable();
            $table->string('approver_designation')->nullable();
            $table->timestamp('approver_signtime')->nullable();

            // Effectiveness
            $table->text('effectiveness')->nullable();

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
        Schema::dropIfExists('table_capas');
    }
};
