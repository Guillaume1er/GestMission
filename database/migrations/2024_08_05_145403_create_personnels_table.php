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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->longText('nomPrenomsPersonnel');
            $table->string('numeroMatricule');
            $table->string('civilite');
            $table->string('contact');
            $table->string('email');
            $table->string('adresse');
            $table->string('fonction');
            $table->integer('numIfu')->nullable();

            $table->foreignId('rang_id')
                ->references('id')
                ->on('rangs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('indice_id')
                ->references('id')
                ->on('indices')
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
        Schema::dropIfExists('personnels');
    }
};
