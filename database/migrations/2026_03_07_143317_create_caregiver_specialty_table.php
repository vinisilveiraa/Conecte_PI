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
        Schema::create('caregiver_specialty', function (Blueprint $table) {
            // apontando para a tabela 'caregivers'
            $table->foreignId('caregiver_id')->constrained()->onDelete('cascade');

            // Apontando para a tabela 'specialties'
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');

            // Seu campo de valor mínimo
            $table->decimal('min_price', 10, 2);

            // Chave Primária Composta para evitar duplicidade
            $table->primary(['caregiver_id', 'specialty_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caregiver_specialty');
    }
};
