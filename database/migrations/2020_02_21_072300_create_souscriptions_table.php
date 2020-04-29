<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_souscription')->nullable();
            $table->unsignedInteger('apport_initial')->nullable();
            $table->unsignedInteger('solde_initial')->nullable();
            $table->unsignedInteger('client_id')->nullable()->index();
            $table->unsignedInteger('maison_id')->nullable()->index();
            $table->string('option_paiement')->nullable();
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
        Schema::dropIfExists('souscriptions');
    }
}
