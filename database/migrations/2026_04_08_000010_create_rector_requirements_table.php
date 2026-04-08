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
        Schema::create('rector_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('requirement_order')->index();
            $table->string('label', 160);
            $table->string('title', 220);
            $table->text('description');
            $table->json('details')->nullable();
            $table->string('tab_color', 20)->default('#36b6a5');
            $table->string('gradient_start', 20)->default('#299a8d');
            $table->string('gradient_middle', 20)->default('#36b6a5');
            $table->string('gradient_end', 20)->default('#268d83');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rector_requirements');
    }
};
