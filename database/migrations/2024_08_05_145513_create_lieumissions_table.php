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
        Schema::create('lieumissions', function (Blueprint $table) {
            $table->id();
            $table->string('commune')->unique();
            $table->string('distance');
            $table->boolean('nuite');
            $table->integer('nombreRepas')->default('1');

            $table->foreignId('departement_id')
            ->references('id')
            ->on('lieumission')
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
        Schema::dropIfExists('lieumissions');
    }
};
