<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maisons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('denomination')->nullable();
            $table->string('standing')->nullable();
            $table->unsignedInteger('superficie')->nullable();
            $table->unsignedInteger('prix_unitaire')->nullable();
            $table->unsignedInteger('programme_id')->nullable()->index();
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
        Schema::dropIfExists('maisons');
    }
}
