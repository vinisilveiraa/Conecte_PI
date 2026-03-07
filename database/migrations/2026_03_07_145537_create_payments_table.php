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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("proposal_id")->constrained()->onDelete("cascade");
            $table->decimal("amount", 10, 2);
            $table->decimal("platform_fee", 10, 2);
            $table->decimal("caregiver_amount", 10, 2);
            $table->enum("status", [
                'pending',      // Aguardando o cliente ler o QR Code
                'paid',         // Pix confirmado (Dinheiro na conta da plataforma)
                'held',         // Em custódia (período de 24h pós-serviço)
                'released',     // Pix transferido para o cuidador
                'refunded',     // Estorno realizado
                'canceled'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
