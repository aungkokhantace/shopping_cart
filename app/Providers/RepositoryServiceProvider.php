<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Role\RoleRepositoryInterface', 'App\Repositories\Role\RoleRepository');
        $this->app->bind('App\Repositories\Permission\PermissionRepositoryInterface', 'App\Repositories\Permission\PermissionRepository');

        $this->app->bind('App\Repositories\Item\ItemRepositoryInterface', 'App\Repositories\Item\ItemRepository');
        $this->app->bind('App\Repositories\Customer\CustomerRepositoryInterface', 'App\Repositories\Customer\CustomerRepository');

        $this->app->bind('App\Repositories\Transaction\TransactionRepositoryInterface', 'App\Repositories\Transaction\TransactionRepository');
        $this->app->bind('App\Repositories\TransactionDetail\TransactionDetailRepositoryInterface', 'App\Repositories\TransactionDetail\TransactionDetailRepository');
    }
}
