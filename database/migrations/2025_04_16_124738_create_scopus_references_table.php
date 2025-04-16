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
        Schema::create('scopus_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_analysis_id')->references('id')->on('journal_analysis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('authors')->nullable();
            $table->string('citations')->nullable();
            $table->string('doi')->nullable();
            $table->string('publication_name')->nullable();
            $table->string('publication_year')->nullable();
            $table->text('title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scopus_references');
    }
};
