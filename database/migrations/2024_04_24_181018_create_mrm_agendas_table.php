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
        Schema::create('mrm_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_no')->nullable();
            $table->string('meeting_date')->nullable();
            $table->string('review_period')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('venue')->nullable();

            $table->string('review_item1')->nullable();
            $table->string('review_item2')->nullable();
            $table->string('review_item3')->nullable();

            $table->string('review_item4')->nullable();
            $table->string('review_item5')->nullable();
            $table->string('review_item6')->nullable();

            $table->string('review_item7')->nullable();
            $table->string('review_item8')->nullable();
            $table->string('review_item9')->nullable();

            $table->string('review_item10')->nullable();
            $table->string('review_item11')->nullable();
            $table->string('review_item12')->nullable();

            $table->string('review_item13')->nullable();
            $table->string('review_item14')->nullable();
            $table->string('review_item15')->nullable();

            $table->string('review_item16')->nullable();
            $table->string('review_item17')->nullable();
            $table->string('review_item18')->nullable();

            $table->string('review_item19')->nullable();
            $table->string('review_item20')->nullable();

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
        Schema::dropIfExists('mrm');
    }
};
