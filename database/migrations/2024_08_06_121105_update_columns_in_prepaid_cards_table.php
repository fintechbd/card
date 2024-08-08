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
        Schema::table('prepaid_cards', function (Blueprint $table) {
            $table->json('timeline')->nullable()->after('instant_card_data');
            $table->string('block_reason')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prepaid_cards', function (Blueprint $table) {
            $table->dropColumn('timeline');
            $table->dropColumn('block_reason');
        });
    }
};
