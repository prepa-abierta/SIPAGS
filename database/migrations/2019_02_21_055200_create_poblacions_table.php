<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoblacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poblacions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('Clave_Poblacion')->nullable()->unsigned();//id
            $table->integer('Clave_Entidad')->nullable()->unsigned();//state_id
            $table->char('Poblacion_Dsc',80)->nullable();//name

            $table->timestamps();


             $table->foreign('Clave_Entidad')->references('id')->on('entidads')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poblacions');
    }
}
