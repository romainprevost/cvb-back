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
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 255);
            $table->text('content');
            $table->string('auteur', 50);
            $table->string('photo');
            $table->foreignId(column: 'equipe_jeune_id')->nullable()->constrained(table: 'equipe_jeunes');
            $table->foreignId(column: 'equipe_senior_id')->nullable()->constrained(table: 'equipe_seniors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
