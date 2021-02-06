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
        DB::table('users')->truncate();

        $records = array(
            ['id' => 1, 'name' => 'Admin', 'role_id' => 1, 'email' => 'admin@gmail.com', 'password' => bcrypt('admin@123')]
        );

        DB::table('users')->insert($records);
    }
}
