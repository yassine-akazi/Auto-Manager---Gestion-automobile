<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            if (!Schema::hasColumn('purchases', 'date_achat')) {
                $table->date('date_achat')->nullable();
            }
            if (!Schema::hasColumn('purchases', 'payment_method')) {
                $table->enum('payment_method',['cash','cheque','virement'])->nullable();
            }
            if (!Schema::hasColumn('purchases', 'cheque_scan')) {
                $table->string('cheque_scan')->nullable();
            }
            if (!Schema::hasColumn('purchases', 'prix_total')) {
                $table->decimal('prix_total',12,2)->default(0);
            }
            if (!Schema::hasColumn('purchases', 'avance')) {
                $table->decimal('avance',12,2)->default(0);
            }
            if (!Schema::hasColumn('purchases', 'reste')) {
                $table->decimal('reste',12,2)->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn(['date_achat','payment_method','cheque_scan','prix_total','avance','reste']);
        });
    }
};