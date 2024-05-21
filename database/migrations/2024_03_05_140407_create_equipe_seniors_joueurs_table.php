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
        Schema::create('equipe_seniors_joueurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'joueur_id')->constrained(table: 'joueurs')->onDelete('cascade');
            $table->foreignId(column: 'equipe_senior_id')->constrained(table: 'equipe_seniors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipe_seniors_joueurs');
    }
};
