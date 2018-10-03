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
        DB::table('users')->truncate();

        DB::table('users')->insert([
  				    ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Admin User'],
        	]);
    }
}
