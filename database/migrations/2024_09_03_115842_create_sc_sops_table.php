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
        Schema::create('sc_sops', function (Blueprint $table) {
            $table->id();
            $table->string('department')->nullable();
            $table->string('doc_no')->nullable();
            $table->string('doc_name')->nullable();
            $table->date('eff_date')->nullable();
            $table->string('revision_no')->nullable();
            $table->string('pdf_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_sops');
    }
};
