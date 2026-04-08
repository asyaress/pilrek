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
        Schema::create('timeline_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('stage_order')->index();
            $table->string('date_label', 120);
            $table->string('title', 180);
            $table->text('description');
            $table->string('status', 20)->default('upcoming');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_stages');
    }
};
