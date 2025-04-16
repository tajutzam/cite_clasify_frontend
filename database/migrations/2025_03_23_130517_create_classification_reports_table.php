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
        Schema::create('classification_reports', function (Blueprint $table) {
            $table->id();
            $table->float('accuracy');
            $table->json('classification_report');
            $table->string('confusion_matrix');
            $table->float('test_size');
            $table->integer('total_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classification_reports');
    }
};
