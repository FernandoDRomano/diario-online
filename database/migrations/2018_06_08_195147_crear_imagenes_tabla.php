<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearImagenesTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            //PARA ESTABLECER LA RELACION CON LA TABLA EMPLEADOS Y CATEGORIAS
            $table->unsignedInteger('noticia_id');
            $table->foreign('noticia_id')->references('id')->on('noticias')->onDelete('cascade');;
            //PARA LAS COLUMNAS DE CREAR Y ACTUALIZAR LOS REGISTROS
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
        Schema::dropIfExists('imagenes');
    }
}
