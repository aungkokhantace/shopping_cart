<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $existingPermissions = DB::select('SELECT id FROM permissions');

        $permissions = array(
            ['id' => '1', 'module' => 'Home', 'action' => 'Home Page', 'description' => 'Display home page', 'route_name' => 'home', 'method' => 'get'],

            ['id' => '11', 'module' => 'Role', 'action' => 'List', 'description' => 'Display role list', 'route_name' => 'roles.index', 'method' => 'get'],
            ['id' => '12', 'module' => 'Role', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'roles.create', 'method' => 'get'],
            ['id' => '13', 'module' => 'Role', 'action' => 'Store', 'description' => 'Store a new role', 'route_name' => 'roles.store', 'method' => 'post'],
            ['id' => '14', 'module' => 'Role', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'roles.edit', 'method' => 'get'],
            ['id' => '15', 'module' => 'Role', 'action' => 'Update', 'description' => 'Update role', 'route_name' => 'roles.update', 'method' => 'put'],
            ['id' => '16', 'module' => 'Role', 'action' => 'Delete', 'description' => 'Delete role', 'route_name' => 'roles.destroy', 'method' => 'delete'],
            ['id' => '17', 'module' => 'Role', 'action' => 'Edit Permissions', 'description' => 'Edit permissions for given role', 'route_name' => 'role.edit_permissions', 'method' => 'get'],
            ['id' => '18', 'module' => 'Role', 'action' => 'Update Permissions', 'description' => 'Update permissions for given role', 'route_name' => 'role.update_permissions', 'method' => 'post'],

            ['id' => '21', 'module' => 'Permission', 'action' => 'List', 'description' => 'Display permission list', 'route_name' => 'permissions.index', 'method' => 'get'],
            ['id' => '22', 'module' => 'Permission', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'permissions.create', 'method' => 'get'],
            ['id' => '23', 'module' => 'Permission', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'permissions.store', 'method' => 'post'],
            ['id' => '24', 'module' => 'Permission', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'permissions.edit', 'method' => 'get'],
            ['id' => '25', 'module' => 'Permission', 'action' => 'Update', 'description' => 'Update permission', 'route_name' => 'permissions.update', 'method' => 'put'],
            ['id' => '26', 'module' => 'Permission', 'action' => 'Delete', 'description' => 'Delete permission', 'route_name' => 'permissions.destroy', 'method' => 'delete'],

            ['id' => '31', 'module' => 'Items', 'action' => 'List', 'description' => 'Display item list', 'route_name' => 'items.index', 'method' => 'get'],
            ['id' => '32', 'module' => 'Items', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'items.create', 'method' => 'get'],
            ['id' => '33', 'module' => 'Items', 'action' => 'Store', 'description' => 'Store a new item', 'route_name' => 'items.store', 'method' => 'post'],
            ['id' => '34', 'module' => 'Items', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'items.edit', 'method' => 'get'],
            ['id' => '35', 'module' => 'Items', 'action' => 'Update', 'description' => 'Update item', 'route_name' => 'items.update', 'method' => 'put'],
            ['id' => '36', 'module' => 'Items', 'action' => 'Delete', 'description' => 'Delete item', 'route_name' => 'items.destroy', 'method' => 'delete'],

            ['id' => '41', 'module' => 'Frontend Items', 'action' => 'List', 'description' => 'Display item list', 'route_name' => 'frontend.items.index', 'method' => 'get'],
            ['id' => '42', 'module' => 'Frontend Items', 'action' => 'Detail', 'description' => 'Display item detail', 'route_name' => 'frontend.items.detail', 'method' => 'get'],
            ['id' => '43', 'module' => 'Frontend Items', 'action' => 'Add to cart', 'description' => 'Add to cart', 'route_name' => 'frontend.items.add_to_cart', 'method' => 'post'],

            ['id' => '51', 'module' => 'Customers', 'action' => 'List', 'description' => 'Display Customer list', 'route_name' => 'customers.index', 'method' => 'get'],
            ['id' => '52', 'module' => 'Customers', 'action' => 'View', 'description' => 'View Customer Detail', 'route_name' => 'customers.show', 'method' => 'get'],

            ['id' => '61', 'module' => 'Cart', 'action' => 'View Cart', 'description' => 'View Cart', 'route_name' => 'cart.view', 'method' => 'get'],
            ['id' => '62', 'module' => 'Cart', 'action' => 'Add to Cart', 'description' => 'Add to Cart', 'route_name' => 'cart.add', 'method' => 'get'],
            ['id' => '63', 'module' => 'Cart', 'action' => 'Update Cart', 'description' => 'Update Cart', 'route_name' => 'cart.update', 'method' => 'put'],
            ['id' => '64', 'module' => 'Cart', 'action' => 'Remove from Cart', 'description' => 'Remove from Cart', 'route_name' => 'cart.remove', 'method' => 'get'],
            // ['id' => '64', 'module' => 'Cart', 'action' => 'Remove from Cart', 'description' => 'Remove from Cart', 'route_name' => 'cart.remove', 'method' => 'delete'],

            ['id' => '65', 'module' => 'Cart', 'action' => 'Checkout', 'description' => 'Checkout', 'route_name' => 'cart.checkout', 'method' => 'post'],

            ['id' => '70', 'module' => 'Frontend Transactions', 'action' => 'List', 'description' => 'View Transaction List', 'route_name' => 'frontend.transactions.list', 'method' => 'get'],
            ['id' => '71', 'module' => 'Frontend Transactions', 'action' => 'Detail', 'description' => 'View Transaction Detail', 'route_name' => 'frontend.transactions.detail', 'method' => 'get'],

            ['id' => '80', 'module' => 'Transactions', 'action' => 'List', 'description' => 'View Transaction List', 'route_name' => 'transactions.list', 'method' => 'get'],
            ['id' => '81', 'module' => 'Transactions', 'action' => 'Detail', 'description' => 'View Transaction Detail', 'route_name' => 'transactions.detail', 'method' => 'get'],


        );

        if (isset($existingPermissions) && count($existingPermissions) > 0) {

            $newPermissions = array();

            foreach ($permissions as $defaultPermission) {

                $existFlag = 0;
                foreach ($existingPermissions as $existPermission) {

                    if ($defaultPermission['id'] == $existPermission->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newPermissions, $defaultPermission);
                }
            }

            if (count($newPermissions) > 0) {
                DB::table('permissions')->insert($newPermissions);
            }
        } else {
            DB::table('permissions')->insert($permissions);
        }

        echo "\n";
        echo "****************************************";
        echo "\n";
        echo "** Finished Running Permission Seeder **";
        echo "\n";
        echo "****************************************";
        echo "\n";
    }
}
