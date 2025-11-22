<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            if (!Schema::hasColumn('cars', 'date_dachat')) {
                $table->date('date_dachat')->after('prix_vente');
            }
        });
    }
    
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('date_dachat');
        });
    }
};
