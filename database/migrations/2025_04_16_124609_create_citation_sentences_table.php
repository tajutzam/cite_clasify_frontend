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
        Schema::create('citation_sentences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_analysis_id')->references('id')->on('journal_analysis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('accuracy');
            $table->string('label');
            $table->text('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citation_sentences');
    }
};
