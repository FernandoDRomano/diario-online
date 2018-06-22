<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('users')->insert([
          'email' => 'admin@admin',
          'password' => bcrypt('1234'),
          'role_id' => '1',
      ]);

      DB::table('users')->insert([
          'email' => 'maxi@gmail.com',
          'password' => bcrypt('1234'),
          'role_id' => '2',
      ]);

      DB::table('users')->insert([
          'email' => 'eva@gmail.com',
          'password' => bcrypt('1234'),
          'role_id' => '2',
      ]);

      DB::table('users')->insert([
          'email' => 'moderador@gmail.com',
          'password' => bcrypt('1234'),
          'role_id' => '3',
      ]);

    }
}
