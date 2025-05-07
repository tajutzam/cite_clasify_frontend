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
        Schema::table('scopus_references', function (Blueprint $table) {
            $table->string('issn')->nullable();
            $table->string('cite_score')->nullable();
            $table->string('sjr')->nullable();
            $table->string('snip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scopus_references', function (Blueprint $table) {
            //
            $table->dropColumn(
                [
                    'issn',
                    'cite_score',
                    'sjr',
                    'snip'
                ]
            );
        });
    }
};
