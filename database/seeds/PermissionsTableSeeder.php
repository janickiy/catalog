<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        DB::table('permissions')->insert([
              ['id' => '1', 'name' => 'manage_user', 'display_name' => 'Manage Users', 'description' => 'Manage Users'],
              ['id' => '2', 'name' => 'add_user', 'display_name' => 'Add User', 'description' => 'Add User'],
              ['id' => '3', 'name' => 'edit_user', 'display_name' => 'Edit User', 'description' => 'Edit User'],
              ['id' => '4', 'name' => 'delete_user', 'display_name' => 'Delete User', 'description' => 'Delete User'],

              ['id' => '5', 'name' => 'manage_role', 'display_name' => 'Manage Roles', 'description' => 'Manage Roles'],
              ['id' => '6', 'name' => 'add_role', 'display_name' => 'Add Role', 'description' => 'Add Role'],
              ['id' => '7', 'name' => 'edit_role', 'display_name' => 'Edit Role', 'description' => 'Edit Role'],
              ['id' => '8', 'name' => 'delete_role', 'display_name' => 'Delete Role', 'description' => 'Delete Role']
        ]);
    }
}
