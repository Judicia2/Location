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
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->String('numero_V');
            $table->bigInteger('marque')->unsigned();
            $table->String('modele');
            $table->integer('prix');
            $table->string('status');

          
            $table->timestamps();
            $table->foreign('marque')->references('id')->on('table_marques');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
