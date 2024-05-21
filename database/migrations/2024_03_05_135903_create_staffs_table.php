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
        Schema::create('staff', function (Blueprint $table) {
            //le nom est mis au singulier suite erreur de laravel qui ne trouve pas staffs
            $table->id();
            $table->integer('licence')->nullable();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 50);
            $table->string('tel', 15);
            $table->string('fonction', 50);
            $table->string('photo');
            $table->foreignId(column: 'equipe_jeune_id')->constrained(table: 'equipe_jeunes')->nullable();
            $table->foreignId(column: 'equipe_senior_id')->constrained(table: 'equipe_seniors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
