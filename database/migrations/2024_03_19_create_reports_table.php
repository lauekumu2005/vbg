<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->datetime('date_reception');
            $table->string('canal');
            $table->string('type_violence');
            $table->string('zone');
            $table->enum('urgence', ['urgent', 'normal', 'non_prioritaire']);
            $table->enum('statut', ['nouveau', 'en_cours', 'confirme', 'refuse'])->default('nouveau');
            $table->text('description')->nullable();
            $table->string('service_orientation')->nullable();
            $table->text('commentaire_orientation')->nullable();
            $table->datetime('date_confirmation')->nullable();
            $table->datetime('date_orientation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}; 