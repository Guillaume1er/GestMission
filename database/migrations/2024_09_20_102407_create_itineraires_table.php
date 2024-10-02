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
        Schema::create('itineraires', function (Blueprint $table) {
            $table->id();
            $table->string('depart');
            $table->string('arrive');
            $table->boolean('allerRetour')->default(false);
            $table->float('distance_km');
            $table->float('distance_total_km')->nullable();
            $table->float('volume_essence_l');
            $table->float('cout_carburant');
            $table->float('montant_carburant');
        
            // Foreign keys
            $table->foreignId('vehicule_id')->constrained('vehicules');
            $table->foreignId('lieumission_id')->constrained('lieumission');
            $table->foreignId('mission_id')->constrained('mission');
        
            $table->timestamps();
        });
        
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraires');
    }
};
