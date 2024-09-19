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
        Schema::create('detailmissions', function (Blueprint $table) {
            $table->id();
            $table->date('dateTraitementMission')->nullable();
            $table->date('dateDepart')->nullable();
            $table->date('dateRetour')->nullable();
            $table->integer('nbrJour')->nullable();
            $table->integer('nbrNuit')->nullable();
            $table->decimal('coutNuite')->nullable();
            $table->decimal('montantNuite')->nullable();
            $table->string('moyenDeDeplacement')->nullable();
            $table->integer('nbrRepas')->nullable();
            $table->decimal('coutRepas')->nullable();
            $table->decimal('montantRepas')->nullable();
            $table->decimal('montantMission')->nullable();
            $table->decimal('montantAvance')->nullable();
            $table->decimal('montantReste')->nullable();
            $table->date('dateSignatureOm')->nullable();
            $table->string('refOm')->nullable();
            $table->decimal('montantPaye')->nullable();
            $table->longText('observation')->nullable();
            $table->date('dateDernierPayement')->nullable();
            $table->boolean('payementJustifie')->nullable();
            $table->string('etat')->default('non demarrer');
            $table->string('statut')->default('non traité');
            $table->date('dateValidation')->nullable();
            $table->string('validateur')->nullable();
            $table->string('annulateurTraitement')->nullable();
            $table->date('dateAnnulerValidation')->nullable();
            $table->string('traiteurMission')->nullable();
            $table->integer('volumeCarburant')->nullable();
            $table->integer('distanceVehiculeMission')->nullable();

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

            $table->foreignId('personnel_id')
                ->references('id')
                ->on('personnels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('vehicule_id')->nullable()
                ->references('id')
                ->on('vehicules')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailmissions');
    }
};
