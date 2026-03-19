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
            $table->decimal("valor", 10, 2);
            $table->decimal("taxa_plataforma", 10, 2);
            $table->decimal("valor_cuidador", 10, 2);
            $table->enum("status", [
                'pendente',      // Aguardando o cliente ler o QR Code
                'depositado',         // Pix confirmado (Dinheiro na conta da plataforma)
                'em_custodia',         // Em custódia (período de 24h pós-serviço)
                'pago',     // Pix transferido para o cuidador
                'estorno_realizado',     // Estorno realizado
                'cancelado'
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
