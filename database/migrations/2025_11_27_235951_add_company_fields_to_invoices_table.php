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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('entreprise_nom')->nullable();
            $table->string('entreprise_adresse')->nullable();
            $table->string('entreprise_tel')->nullable();
        });
    }
    
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['entreprise_nom', 'entreprise_adresse', 'entreprise_tel']);
        });
    }
};
