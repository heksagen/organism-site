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
    Schema::create('species_sections', function (Blueprint $table) {
        $table->id();
        $table->foreignId('species_id')->constrained('species')->cascadeOnDelete();
        $table->string('key');              // e.g. geography, taxonomy, morphology
        $table->string('title');            // heading shown on page
        $table->longText('content')->nullable(); // store text/markdown/html
        $table->boolean('is_enabled')->default(true);
        $table->unsignedInteger('sort_order')->default(0);
        $table->timestamps();

        $table->unique(['species_id', 'key']); // one section per key per species
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species_sections');
    }
};
