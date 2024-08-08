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
        Schema::create('vehiculemissions', function (Blueprint $table) {
            $table->id();
            $table->integer('qteCarburantAffecte');
            $table->integer('kilometrageDepart');
            $table->integer('kilometrageFinMission');

            $table->foreignId('mission_id')
                ->references('id')
                ->on('missions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->foreignId('lieuMission_id')
                ->references('id')
                ->on('lieumissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->foreignId('vehicule_id')
                ->references('id')
                ->on('vehicules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculemissions');
    }
};
