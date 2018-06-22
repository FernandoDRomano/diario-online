<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearUsersTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('email')->unique();
          $table->string('password');
          //PARA ESTABLECER LA RELACION CON LA TABLA ROLE
          $table->unsignedInteger('role_id');
          $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
