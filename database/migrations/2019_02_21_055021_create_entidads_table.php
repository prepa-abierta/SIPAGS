<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('entidads');
        Schema::create('entidads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Clave_Entidad')->nullable()->unsigned();
            $table->char('Entidad_Dsc',40)->nullable();
            $table->char('Abreviatura_Entidad',40)->nullable();
            /*$table->integer('Clave_Curp')->nullable()->unsigned();
            $table->integer('Clave_Entidad_real')->nullable()->unsigned();*/

            $table->timestamps();

            //$table->primary('Clave_entidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entidads');
    }
}
