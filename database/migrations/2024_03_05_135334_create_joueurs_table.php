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
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->integer('licence');
            $table->enum('genre',['M', 'F']);
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->date('date_de_naissance');
            $table->string('email', 50);
            $table->string('tel', 15)->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
