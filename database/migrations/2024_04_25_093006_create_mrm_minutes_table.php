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
        Schema::create('mrm_minutes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mrm_agenda_id')->references('id')->on('mrm_agendas')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->string('decision1')->nullable();
            $table->string('action1')->nullable();
            $table->string('responsible1')->nullable();
            $table->date('completion_date1')->nullable();
            $table->string('remarks1')->nullable();

            $table->string('decision2')->nullable();
            $table->string('action2')->nullable();
            $table->string('responsible2')->nullable();
            $table->date('completion_date2')->nullable();
            $table->string('remarks2')->nullable();

            $table->string('decision3')->nullable();
            $table->string('action3')->nullable();
            $table->string('responsible3')->nullable();
            $table->date('completion_date3')->nullable();
            $table->string('remarks3')->nullable();

            $table->string('decision4')->nullable();
            $table->string('action4')->nullable();
            $table->string('responsible4')->nullable();
            $table->date('completion_date4')->nullable();
            $table->string('remarks4')->nullable();

            $table->string('decision5')->nullable();
            $table->string('action5')->nullable();
            $table->string('responsible5')->nullable();
            $table->date('completion_date5')->nullable();
            $table->string('remarks5')->nullable();

            $table->string('decision6')->nullable();
            $table->string('action6')->nullable();
            $table->string('responsible6')->nullable();
            $table->date('completion_date6')->nullable();
            $table->string('remarks6')->nullable();

            $table->string('decision7')->nullable();
            $table->string('action7')->nullable();
            $table->string('responsible7')->nullable();
            $table->date('completion_date7')->nullable();
            $table->string('remarks7')->nullable();

            $table->string('decision8')->nullable();
            $table->string('action8')->nullable();
            $table->string('responsible8')->nullable();
            $table->date('completion_date8')->nullable();
            $table->string('remarks8')->nullable();

            $table->string('decision9')->nullable();
            $table->string('action9')->nullable();
            $table->string('responsible9')->nullable();
            $table->date('completion_date9')->nullable();
            $table->string('remarks9')->nullable();

            $table->string('decision10')->nullable();
            $table->string('action10')->nullable();
            $table->string('responsible10')->nullable();
            $table->date('completion_date10')->nullable();
            $table->string('remarks10')->nullable();

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
