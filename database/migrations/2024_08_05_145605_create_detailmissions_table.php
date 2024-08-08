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
            $table->date('dateTraitementMission');
            $table->date('dateDepart');
            $table->date('dateRetour');
            $table->integer('nbrJour');
            $table->integer('nbrNuit');
            $table->decimal('coutNuite');
            $table->decimal('montantNuite');
            $table->integer('nbrRepas');
            $table->decimal('coutRepas');
            $table->decimal('montantRepas');
            $table->decimal('montantMission');
            $table->decimal('montantAvance');
            $table->decimal('montantReste');
            $table->date('dateSignatureOm');
            $table->string('refOm');
            $table->decimal('montantPaye');
            $table->longText('observation');
            $table->date('dateDernierPayement');
            $table->boolean('payementJustifie');
            $table->string('etat');

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
