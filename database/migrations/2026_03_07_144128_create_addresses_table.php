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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("numero")->default("s/n");
            $table->string("logradouro");
            $table->string('bairro');
            $table->string("cidade");
            $table->string("cep", 10);
            $table->string("estado", 2);
            $table->decimal("latitude", 10, 7);
            $table->decimal("longitude", 10, 7);
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
