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
        Schema::create('table_reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('voiture')->unsigned();
            $table->bigInteger('client')->unsigned();
            $table->string('status');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->foreign('voiture')->references('id')->on('voitures');
            $table->foreign('client')->references('id')->on('table_clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_reservations');
    }
};
