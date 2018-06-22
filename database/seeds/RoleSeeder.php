<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('roles')->insert([
          'nombre' => 'Administrador',
          'descripcion' => 'Tiene todos los Permisos del Sistema',
      ]);

      DB::table('roles')->insert([
          'nombre' => 'Escritor',
          'descripcion' => 'Tiene los Permisos para Gestionar las Noticias',
      ]);

      DB::table('roles')->insert([
          'nombre' => 'Moderador',
          'descripcion' => 'Tiene los Permisos para Gestionar los Comentarios',
      ]);

      DB::table('roles')->insert([
          'nombre' => 'Miembro',
          'descripcion' => 'Es el usuario Lector con permiso para Comentar las Noticias',
      ]);

    }
}
