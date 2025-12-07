<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('client_nom')->nullable();
            $table->string('client_societe')->nullable();
            $table->string('client_adresse')->nullable();
            $table->string('client_telephone')->nullable();
            $table->string('client_email')->nullable();
            $table->string('entreprise_nom')->nullable();
            $table->string('entreprise_adresse')->nullable();
            $table->string('entreprise_tel')->nullable();
            $table->string('logo')->nullable();
            $table->json('products')->nullable();
            $table->decimal('tva_rate', 5,2)->default(0.2);
            $table->decimal('total', 12,2)->nullable();
            $table->decimal('montant', 12,2)->nullable();
            $table->string('numero')->nullable();
            $table->timestamp('date_emission')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};