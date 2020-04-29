<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifiant')->nullable()->unique();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->boolean('statut')->nullable();
            $table->string('cni')->nullable();
            $table->string('profession')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('reseau_principal')->nullable();
            $table->string('reseau_secondaire')->nullable();
            $table->string('tel_principal')->nullable();
            $table->string('tel_secondaire')->nullable();
            $table->string('email')->nullable();
            $table->string('banque')->nullable();
            $table->string('numero_compte')->nullable();
            $table->string('adresse')->nullable();
            $table->string('residence')->nullable();
            $table->string('observations')->nullable();
            $table->unsignedInteger('parrain')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
