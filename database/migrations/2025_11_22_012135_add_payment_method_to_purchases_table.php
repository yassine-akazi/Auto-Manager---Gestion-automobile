<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('prix_total', 12, 2);
            $table->decimal('avance', 12, 2)->default(0);
            $table->decimal('reste', 12, 2)->default(0);
            $table->enum('payment_method', ['cash','cheque','virement'])->nullable();
            $table->string('cheque_scan')->nullable();
            $table->date('date_achat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};