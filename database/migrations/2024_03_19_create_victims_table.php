<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('victims', function (Blueprint $table) {
            $table->id();
            $table->string('age');
            $table->string('sexe');
            $table->string('type_violence');
            $table->string('commune');
            $table->text('description')->nullable();
            $table->string('statut')->default('Suivi en cours');
            $table->timestamp('date_identification')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('victims');
    }
}; 