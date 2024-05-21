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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('set_domicile');
            $table->smallInteger('score_domicile');
            $table->smallInteger('set_exterieur');
            $table->smallInteger('score_exterieur');
            $table->foreignId(column: 'equipe_jeune_id')->constrained(table: 'equipe_jeunes')->nullable();
            $table->foreignId(column: 'equipe_senior_id')->constrained(table: 'equipe_seniors')->nullable();
            $table->foreignId(column: 'equipe_adversaire_id')->constrained(table: 'equipe_seniors')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};
