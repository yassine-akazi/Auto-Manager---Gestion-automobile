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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->integer('annee');
            $table->integer('kilometrage');
            $table->decimal('prix_achat',10,2);
            $table->decimal('prix_vente',10,2)->nullable();
         
            $table->date('date_dachat');
            $table->string('matricule_part1');
            $table->string('matricule_part2');
            $table->string('matricule_part3');
            $table->unique(['matricule_part1', 'matricule_part2', 'matricule_part3']);            $table->enum('statut', ['Disponible','Réservée','En réparation','En inspection','En négociation','Vendue','Hors stock'])->default('Disponible');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
