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
            //$table->string('imputation');
            //$table->string('previsionBBudgetaire');
            $table->string('autorisateur1')->nullable();
            $table->string('autorisateur2')->nullable();
            $table->string('autorisateur3')->nullable();
            $table->string('observationMission')->nullable();
            $table->string('etatMission')->default('non demarrer');
            $table->integer('nbrVehicule')->nullable();
            //$table->string('typeMission');
            $table->integer('nbrTotalNuite')->nullable();
            $table->integer('nbrTotalRepas')->nullable();
            $table->decimal('montantTotalNuite')->nullable();
            $table->decimal('montantTotalRepas')->nullable();
            $table->decimal('montantTotalMission')->nullable();

            $table->foreignId('organisateur_id')
            ->constrained('organisateurs') 
            ->onUpdate('cascade')
            ->onDelete('cascade');
    
        $table->foreignId('exerciceBudgetaire_id')
            ->constrained('exercicebudgetaires') 
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
        Schema::dropIfExists('missions');
    }
};
