<?php

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->truncate();

        $records = array(
            // start admin permissions
            ['role_id' => 1, 'permission_id' => 1],

            ['role_id' => 1, 'permission_id' => 11],
            ['role_id' => 1, 'permission_id' => 12],
            ['role_id' => 1, 'permission_id' => 13],
            ['role_id' => 1, 'permission_id' => 14],
            ['role_id' => 1, 'permission_id' => 15],
            ['role_id' => 1, 'permission_id' => 16],
            ['role_id' => 1, 'permission_id' => 17],
            ['role_id' => 1, 'permission_id' => 18],

            ['role_id' => 1, 'permission_id' => 21],
            ['role_id' => 1, 'permission_id' => 22],
            ['role_id' => 1, 'permission_id' => 23],
            ['role_id' => 1, 'permission_id' => 24],
            ['role_id' => 1, 'permission_id' => 25],
            ['role_id' => 1, 'permission_id' => 26],

            ['role_id' => 1, 'permission_id' => 31],
            ['role_id' => 1, 'permission_id' => 32],
            ['role_id' => 1, 'permission_id' => 33],
            ['role_id' => 1, 'permission_id' => 34],
            ['role_id' => 1, 'permission_id' => 35],
            ['role_id' => 1, 'permission_id' => 36],

            ['role_id' => 1, 'permission_id' => 51],
            ['role_id' => 1, 'permission_id' => 52],

            ['role_id' => 1, 'permission_id' => 80],
            ['role_id' => 1, 'permission_id' => 81],

            // start customer permissions
            ['role_id' => 2, 'permission_id' => 41],
            ['role_id' => 2, 'permission_id' => 42],
            ['role_id' => 2, 'permission_id' => 43],

            ['role_id' => 2, 'permission_id' => 61], // view cart
            ['role_id' => 2, 'permission_id' => 62], // add to cart
            ['role_id' => 2, 'permission_id' => 63], // update cart
            ['role_id' => 2, 'permission_id' => 64], // remove from cart
            ['role_id' => 2, 'permission_id' => 65], // checkout cart

            ['role_id' => 2, 'permission_id' => 70],
            ['role_id' => 2, 'permission_id' => 71],
        );

        DB::table('role_permissions')->insert($records);


        echo "\n";
        echo "**********************************************";
        echo "\n";
        echo "** Finished Running Role Permission Seeder **";
        echo "\n";
        echo "**********************************************";
        echo "\n";
    }
}
