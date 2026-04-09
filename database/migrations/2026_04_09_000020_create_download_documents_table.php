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
        Schema::create('download_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('document_order')->index();
            $table->string('title', 220);
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name', 255)->nullable();
            $table->string('file_extension', 20)->nullable();
            $table->unsignedInteger('file_size_kb')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_documents');
    }
};

