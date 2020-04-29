<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcheanciersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echeanciers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('souscription_id')->nullable()->index();
            $table->date('date_echeance')->nullable();
            $table->unsignedInteger('numero_ordre')->nullable();
            $table->unsignedInteger('montant')->nullable();
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
        Schema::dropIfExists('echeanciers');
    }
}
