<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
              "name" => "Ronak Patel",
              "email" => "patelronak2@icloud.com",
              "password" => bcrypt('Ronakpatel181198'),
			  "type" => "admin"
          ]);
		DB::table('users')->insert([
              "name" => "Roney",
              "email" => "ronakpatel72818@gmail.com",
              "password" => bcrypt('Patelronak181198'),
			  "type" => "default"
          ]);
    }
}
