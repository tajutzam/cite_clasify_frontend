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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('creator')->nullable();
            $table->string('journal')->nullable();
            $table->string('volume')->nullable();
            $table->string('issue')->nullable();
            $table->string('date')->nullable();
            $table->string('doi')->unique()->nullable();
            $table->integer('citedby')->default(0);
            $table->string('affiliation_name')->nullable();
            $table->string('affiliation_city')->nullable();
            $table->string('affiliation_country')->nullable();
            $table->string('scopus_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
