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
        Schema::create('lignes_commandes', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('quantite');
            $table->smallInteger('numero');
            $table->string('initiales', 3);
            $table->decimal('sous_total', 6, 2);
            $table->foreignId(column: 'commande_id')->constrained(table: 'commandes')->nullable();
            $table->foreignId(column: 'article_id')->constrained(table: 'articles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes_commandes');
    }
};
