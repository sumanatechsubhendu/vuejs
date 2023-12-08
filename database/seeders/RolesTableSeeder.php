<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // You can customize the roles as needed
        $roles = [
            ['name' => 'Admin', 'description' => 'Administrator'],
            ['name' => 'Subadmin', 'description' => 'Subadmin'],
            ['name' => 'User', 'description' => 'Regular User'],
            // Add more roles as needed
        ];

        // Insert the roles into the roles table
        DB::table('roles')->insert($roles);
    }
}
