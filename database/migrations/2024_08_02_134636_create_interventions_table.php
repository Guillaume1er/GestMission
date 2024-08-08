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
            $table->string('referenceIntervention')->unique();
            $table->integer('numeroIntervention')->unique();
            $table->date('datePrevue')->nullable();
            $table->date('dateIntervention');
            $table->longText('objetIntervention');
            $table->integer('kilometrageIntervention');
            $table->longText('pannesSurvenues')->nullable();
            $table->longText('reparationEffectue')->nullable();
            $table->decimal('coutGlobal')->nullable();
            $table->boolean('validationIntervention');

            $table->foreignId('vehicule_id')
                ->references('id')
                ->on('vehicules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('typeIntervention_id')
                ->references('id')
                ->on('typeinterventions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('responsableIntervention_id')
                ->references('id')
                ->on('responsableinterventions')
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
        Schema::dropIfExists('interventions');
    }
};
