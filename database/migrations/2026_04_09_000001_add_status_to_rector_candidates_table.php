<?php

use App\Models\RectorCandidate;
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
        Schema::table('rector_candidates', function (Blueprint $table) {
            $table->string('status', 20)
                ->default(RectorCandidate::STATUS_CALON)
                ->after('candidate_order')
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rector_candidates', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
