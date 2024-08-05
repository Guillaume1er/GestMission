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
            $table->integer('kilometrageDepart');
            $table->string('responsableVehicule');
            $table->integer('contactResponsable');
            $table->string('etatVehicule');
            $table->boolean('autorisationSortie');
            $table->date('dateAutorisation');
            $table->date('dateEnregistrementVehicule');
            $table->string('immatriculation');
            $table->boolean('vehiculePool');
            $table->longText('motifDesautorisation');
            $table->date('dateDesautorisation');
            $table->integer('kilometrageActuel');
            $table->integer('kilometrageAlerte');
            $table->date('dateDerniereMission');
            $table->date('dateAcquisition');
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
