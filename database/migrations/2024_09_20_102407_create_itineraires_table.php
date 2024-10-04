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
            $table->float('distance_total_km');
            $table->foreignId('vehicule_id')->nullable()
            ->references('id')
            ->on('vehicules')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('lieumission_id')->nullable()
            ->references('id')
            ->on('lieumissions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('mission_id')->nullable()
            ->references('id')
            ->on('missions')
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
        Schema::dropIfExists('itineraires');
    }
};
