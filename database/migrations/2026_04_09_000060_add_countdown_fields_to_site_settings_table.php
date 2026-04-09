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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('countdown_title')->nullable()->after('site_tagline');
            $table->string('countdown_subtitle')->nullable()->after('countdown_title');
            $table->dateTime('countdown_target_at')->nullable()->after('countdown_subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'countdown_title',
                'countdown_subtitle',
                'countdown_target_at',
            ]);
        });
    }
};
