<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearEmpleadosTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apellido', 45);
            $table->string('nombre', 45);
            $table->date('fechaNacimiento');
            $table->integer('dni');
            $table->boolean('estado');
            $table->string('foto');
            //PARA ESTABLECER LA RELACION CON LA TABLA USUARIOS
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
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
        Schema::dropIfExists('empleados');
    }
}
