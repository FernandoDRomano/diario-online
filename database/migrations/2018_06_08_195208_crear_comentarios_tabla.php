<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearComentariosTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('mensaje');
            $table->date('fecha');
            //PARA ESTABLECER LA RELACION CON LA TABLA LECTORES Y NOTICIAS
            $table->unsignedInteger('lector_id');
            $table->foreign('lector_id')->references('id')->on('lectores')->onDelete('cascade');

            $table->unsignedInteger('noticia_id');
            $table->foreign('noticia_id')->references('id')->on('noticias')->onDelete('cascade');
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
        Schema::dropIfExists('comentarios');
    }
}
