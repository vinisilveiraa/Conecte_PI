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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_servico');
            $table->datetime('data_inicio');
            $table->datetime('data_fim');
            $table->text("descricao_servico");
            $table->string("endereco_servico");
            $table->enum("status", ["pending", "accepted", "rejected", "completed", "cancelled"])->default("pending");

            $table->integer('estrela')->nullable(); // tirar?

            $table->datetime('accepted_at')->nullable();
            $table->datetime('finished_at')->nullable();
            $table->datetime('cancelled_at')->nullable();

            $table->foreignId("client_id")->constrained()->onDelete("cascade");
            $table->foreignId("caregiver_id")->constrained()->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
