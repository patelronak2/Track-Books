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
              "email" => "patelronak2@hotmail.com",
              "password" => "Ronakpatel181198"
			  "verified" => true
          ]);
    }
}
