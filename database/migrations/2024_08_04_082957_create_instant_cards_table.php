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
        Schema::create('instant_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('user_account_id')->nullable()->comment('currency');
            $table->string('type')->default( 'virtual');
            $table->string('scheme')->default( 'default');
            $table->string('name');
            $table->string('number')->nullable();
            $table->string('cvc')->nullable();
            $table->string('pin')->nullable();
            $table->string('provider')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->decimal('balance')->default(0);
            $table->json('instant_cards_data')->nullable();
            $table->foreignId('approver_id')->nullable();
            $table->foreignId('creator_id')->nullable();
            $table->foreignId('editor_id')->nullable();
            $table->foreignId('destroyer_id')->nullable();
            $table->foreignId('restorer_id')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('restored_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instant_cards');
    }
};
