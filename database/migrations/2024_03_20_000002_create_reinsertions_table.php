<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reinsertions', function (Blueprint $table) {
            $table->id();
            $table->string('code_victime');
            $table->string('nom_anonyme');
            $table->string('type_reinsertion');
            $table->dateTime('date_debut');
            $table->foreignId('partenaire_id')->constrained()->onDelete('cascade');
            $table->string('statut');
            $table->integer('evolution')->default(0);
            $table->string('localisation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reinsertions');
    }
}; 