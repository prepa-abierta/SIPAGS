<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAspirantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('aspirantes');
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->increments('id');


            $table->char('Curp',18)->nullable();
            $table->char('Nombre',40)->nullable();
            $table->char('Primer_Apellido',40)->nullable();
            $table->char('Segundo_Apellido',40)->nullable();
            $table->char('Sexo',1)->nullable();
            $table->timestamp('Fecha_Nacimiento')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('Lugar_Nacimiento')->unsigned()->nullable();
            $table->integer('Estado_Nacimiento')->unsigned()->nullable();
            $table->boolean('Nacionalidad')->nullable();
            $table->integer('Clave_Pais_Nacimiento')->unsigned()->nullable();
            $table->char('Telefono',40)->nullable();
            $table->char('Correo',40)->nullable();
            $table->char('Celular',40)->nullable();
            $table->boolean('Discapacidad')->nullable();
            $table->integer('discapacidad_id')->unsigned()->nullable();
            $table->char('Edad', 3)->nullable();
            $table->char('Codigo_Postal',5)->nullable();
            $table->integer('estado')->nullable()->unsigned();
            $table->integer('municipio')->nullable()->unsigned();
            $table->integer('Colonia')->nullable()->unsigned();
            $table->char('Direccion',40)->nullable();
            $table->char('Nivel_Escolaridad', 20)->nullable();
            $table->char('Escuela_Procedencia',250)->nullable();
            $table->integer('Clave_Ultimo_Grado')->nullable()->unsigned();
            $table->year('Anio_Egreso')->nullable()->unsigned();
            $table->char('Numero_Certificado',40)->nullable();
            $table->integer('pais_id')->nullable()->unsigned();
            $table->integer('estado_id')->nullable()->unsigned();
            $table->integer('municipio_id')->nullable()->unsigned();
            $table->integer('Folio_Surems')->nullable()->unsigned();
            $table->integer('Estatus')->nullable()->unsigned();

            $table->timestamps();

            $table->foreign('pais_id')->references('id')->on('pais')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('estado_id')->references('id')->on('entidads')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('municipio_id')->references('id')->on('poblacions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('discapacidad_id')->references('id')->on('discapacidads')
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
        Schema::dropIfExists('aspirantes');
    }
}
