<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearNoticiasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 255);
            $table->string('subTitulo', 255);
            $table->text('contenido');
            $table->date('fecha');
            //PARA ESTABLECER LA RELACION CON LA TABLA EMPLEADOS Y CATEGORIAS
            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->unsignedInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');

            //PARA LAS COLUMNAS DE CREAR Y ACTUALIZAR LOS REGISTROS
            $table->timestamps();
        });

        //PARA CREAR LA TABLA PIVOT, QUE DA LA RELACION DE MUCHOS A MUCHOS EN LA BD, EN ESTE CASO ENTRE NOTICIAS Y ETIQUETAS
        Schema::create('etiqueta_noticia', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('etiqueta_id');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas')->onDelete('cascade');
            $table->unsignedInteger('noticia_id');
            $table->foreign('noticia_id')->references('id')->on('noticias')->onDelete('cascade');
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
        Schema::dropIfExists('noticias');
    }
}
