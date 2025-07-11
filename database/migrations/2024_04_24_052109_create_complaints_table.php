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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('department')->nullable();
            $table->string('complaint_no')->nullable();
            $table->date('receipt_date')->nullable();
            $table->string('customer')->nullable();
            $table->string('detail')->nullable();
            $table->string('category')->nullable();
            $table->string('product')->nullable();
            $table->string('batch')->nullable();
            $table->string('serial')->nullable();
            $table->date('expiry')->nullable();
            $table->string('quantity')->nullable();
            $table->string('capa_init')->nullable();
            $table->string('capa_no')->nullable();
            $table->string('capa_status')->nullable();
            $table->string('associate_name')->nullable();
            $table->string('associate_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint');
    }
};
