<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        view()->composer('', function () {
//
//        });

        // userList
        view()->composer(array('approval.approversettings.create', 'approval.approversettings.edit',
            'teaching.teachingadministrator.create', 'teaching.teachingadministrator.edit', 'purchase.payments.create_hxold',
            'changeuser'), function($view) {
            $view->with('userList', \App\User::where('email', '<>', 'admin@admin.com')->orderby('name', 'asc')->pluck('name', 'id'));
        });

        // material_catList
        view()->composer(array('basic.materials.create', 'basic.materials.edit',
            'teaching.teachingadministrator.create', 'teaching.teachingadministrator.edit', 'purchase.payments.create_hxold',
            'changeuser'), function($view) {
            $view->with('material_catList', \App\Models\Basic\Material_cat::pluck('name', 'id'));
        });

        //warehouse_List
        view()->composer(array('inventory.warehouseinheads.create', 'inventory.warehouseinheads.edit','inventory.warehouseoutheads.create', 'inventory.warehouseoutheads.edit',
            ), function($view) {
            $view->with('warehouse_List', \App\Models\Inventory\Warehouse::pluck('name', 'id'));
        });

        //user_List
        view()->composer(array('sales.soheads.createreceipt',
        ), function($view) {
            $view->with('user_List', \App\User::pluck('name', 'id'));
        });

        //paymethod_List
        view()->composer(array('sales.soheads.createreceipt',
        ), function($view) {
                $view->with('paymethod_List', \App\Models\Basic\Paymethod::pluck('name','id'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
