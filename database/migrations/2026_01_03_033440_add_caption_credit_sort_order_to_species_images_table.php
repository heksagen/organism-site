<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('species_images', function (Blueprint $table) {
            $table->string('caption')->nullable();
            $table->text('credit')->nullable();
            $table->integer('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('species_images', function (Blueprint $table) {
            $table->dropColumn(['caption', 'credit', 'sort_order']);
        });
    }
};
