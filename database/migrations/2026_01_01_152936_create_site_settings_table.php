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
    Schema::create('site_settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_title')->default('FEATURING PHILIPPINE ENDEMIC MAMMALS');
        $table->string('site_subtitle')->nullable();
        $table->longText('overview_text')->nullable();
        $table->string('hero_image')->nullable(); // file path or URL
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
