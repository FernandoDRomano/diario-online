<?php

use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('empleados')->insert([
          'apellido' => 'Romano',
          'nombre' => 'Fernando Daniel',
          'estado' => true,
          'fechaNacimiento' => '1992-03-05',
          'dni' => '35548988',
          'foto' => 'diario_online_1529597733.png',
          'user_id' => '1',
      ]);

      DB::table('empleados')->insert([
          'apellido' => 'Ruiz',
          'nombre' => 'Jorge Maximiliano',
          'estado' => true,
          'fechaNacimiento' => '1990-08-23',
          'dni' => '35192886',
          'foto' => 'diario_online_1529597756.png',
          'user_id' => '2',
      ]);

      DB::table('empleados')->insert([
          'apellido' => 'Ibarra',
          'nombre' => 'Evangelina',
          'estado' => true,
          'fechaNacimiento' => '1990-07-19',
          'dni' => '34604570',
          'foto' => 'diario_online_1528948928.jpg',
          'user_id' => '3',
      ]);

      DB::table('empleados')->insert([
          'apellido' => 'Perez',
          'nombre' => 'Juan',
          'estado' => true,
          'fechaNacimiento' => '1991-11-23',
          'dni' => '33587123',
          'foto' => 'diario_online_1528949062.jpg',
          'user_id' => '4',
      ]);

    }
}
