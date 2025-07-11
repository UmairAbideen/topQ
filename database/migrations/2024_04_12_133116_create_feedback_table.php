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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('organization');
            $table->string('email');

            $table->string('productquality_ins')->nullable();
            $table->string('economicalsolution_ins')->nullable();
            $table->string('overallservices_ins')->nullable();
            $table->string('responsetocomplaints_ins')->nullable();
            $table->string('remarks_ins')->nullable();

            $table->string('responsetocomplaints_ts')->nullable();
            $table->string('callattendedinscheduledtime_ts')->nullable();
            $table->string('economicalsolution_ts')->nullable();
            $table->string('overallperformance_ts')->nullable();
            $table->string('remarks_ts')->nullable();

            $table->string('productquality_iol')->nullable();
            $table->string('economicalsolution_iol')->nullable();
            $table->string('overallservices_iol')->nullable();
            $table->string('responsetocomplaints_iol')->nullable();
            $table->string('remarks_iol')->nullable();

            $table->string('productquality_de')->nullable();
            $table->string('economicalsolution_de')->nullable();
            $table->string('overallservices_de')->nullable();
            $table->string('responsetocomplaints_de')->nullable();
            $table->string('remarks_de')->nullable();
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
