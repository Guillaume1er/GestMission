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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('plaqueVehicule');
            $table->integer('kilometrageDepart')->nullable();
            $table->string('responsableVehicule');
            $table->string('contactResponsable');
            $table->string('etatVehicule');
            $table->boolean('autorisationSortie')->default(false);
            $table->date('dateAutorisation')->nullable();
            $table->timestamp('dateEnregistrementVehicule')->nullable();
            $table->string('immatriculation')->unique();
            $table->boolean('vehiculePool') ->default(false);
            $table->longText('motifDesautorisation')->nullable();
            $table->date('dateDesautorisation')->nullable();
            $table->integer('kilometrageActuel')->nullable();
            $table->integer('kilometrageAlerte')->nullable();
            $table->date('dateDerniereMission')->nullable();
            $table->date('dateAcquisition');
            $table->string('statut')->default('Bon');
            
            $table->foreignId('typeVehicule_id')
                ->references('id')
                ->on('typevehicules')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('marque_id')
                ->references('id')
                ->on('marques')
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
        Schema::dropIfExists('vehicules');
    }
};
