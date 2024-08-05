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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->integer('numMission');
            $table->string('refMission');
            $table->string('nomMission');
            $table->string('objetMission');
            $table->date('dateMission');
            $table->date('dateDebutMission');
            $table->date('dateFinMission');
            $table->string('imputation');
            $table->string('previsionBBudgetaire');
            $table->string('autorisateur1');
            $table->string('autorisateur2');
            $table->string('autorisateur3');
            $table->string('observationMission');
            $table->string('etatMission');
            $table->integer('nbrVehicule');
            $table->string('typeVehicule');
            $table->interger('nbrTotalNuite');
            $table->interger('nbrTotalRepas');
            $table->decimal('montantTotalNuite');
            $table->decimal('montantTotalRepas');
            $table->decimal('montantTotalMission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
