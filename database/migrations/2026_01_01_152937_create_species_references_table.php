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
    Schema::create('species_references', function (Blueprint $table) {
        $table->id();
        $table->foreignId('species_id')->constrained('species')->cascadeOnDelete();
        $table->text('citation'); // APA7 text
        $table->string('link')->nullable();
        $table->string('type')->nullable(); // e.g. "text", "image"
        $table->unsignedInteger('sort_order')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species_references');
    }
};
