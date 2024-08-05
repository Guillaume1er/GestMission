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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('referenceIntervention');
            $table->integer('numeroIntervention');
            $table->date('datePrevue');
            $table->date('dateIntervention');
            $table->longText('objetIntervention');
            $table->integer('kilometrageIntervention');
            $table->longText('pannesSurvenues');
            $table->decimal('coutGlobal');
            $table->boolean('validationIntervention');
            $table->foreignId('vehicule_id');
            $table->foreignId('typeIntervention_id');
            $table->foreignId('typeIntervention_id');
            $table->foreignId('responsableIntervention_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
