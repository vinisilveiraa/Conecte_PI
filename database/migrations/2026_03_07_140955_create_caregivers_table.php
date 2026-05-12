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
        Schema::create('caregivers', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 24)->unique();
            $table->string('public_code')->unique();
            $table->string('coren', 20)->nullable();
            $table->string('certificado_cuidador')->nullable();

            $table->string('headline')->nullable();
            $table->text("bio")->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('hour_price', 10, 2)->nullable();

            $table->boolean("verificado")->default(false);

            $table->boolean("available_morning")->default(false);
            $table->boolean("available_afternoon")->default(false);
            $table->boolean("available_night")->default(false);
            $table->boolean("available_weekends")->default(false);

            $table->foreignId("user_id")->constrained()->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caregivers');
    }
};
