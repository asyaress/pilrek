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
        Schema::create('rector_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('candidate_order')->index();
            $table->string('name', 180);
            $table->string('slug', 200)->unique();
            $table->string('role_summary', 200)->nullable();
            $table->string('faculty_unit', 180)->nullable();
            $table->string('study_program', 180)->nullable();
            $table->string('academic_position', 180)->nullable();
            $table->string('current_position', 180)->nullable();
            $table->string('latest_education', 180)->nullable();
            $table->string('nip', 50)->nullable();
            $table->string('birth_place', 120)->nullable();
            $table->date('birth_date')->nullable();
            $table->text('short_profile')->nullable();
            $table->text('vision')->nullable();
            $table->json('missions')->nullable();
            $table->string('photo_path', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rector_candidates');
    }
};
