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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proposal_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('revisor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('revisado_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->tinyInteger('avaliacao');

            $table->text('comentario')->nullable();

            $table->timestamps();

            $table->unique(['proposal_id', 'revisor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
