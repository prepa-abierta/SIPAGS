<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('pais', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('Clave_Pais')->nullable()->unsigned();
            $table->char('Pais_Dsc',40)->nullable();
            $table->char('Abreviatura_Pais',40)->nullable();

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
        //Schema::dropIfExists('aspirantes');
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pais');
        Schema::disableForeignKeyConstraints();
    }
}
