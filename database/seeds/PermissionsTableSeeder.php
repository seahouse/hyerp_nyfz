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
        //
        DB::table('permissions')->insert([
            [
                'name' => 'module_basic',
                'display_name' => '基础资料',
            ],
            [
                'name' => 'module_inventory',
                'display_name' => '库存',
            ],
            [
                'name' => 'module_sales',
                'display_name' => '销售',
            ],
            [
                'name' => 'module_purchase',
                'display_name' => '采购',
            ],
            [
                'name' => 'module_system',
                'display_name' => '系统',
            ],
            [
                'name' => 'basic_metrial_view',
                'display_name' => '基础资料_物料_查看',
                'description' => '查看物料',
            ],
            [
                'name' => 'inventory_warehouse_view',
                'display_name' => '库存_仓库_查看',
                'description' => '查看仓库',
            ],
            [
                'name' => 'sales_sohead_view',
                'display_name' => '销售_销售订单_查看',
                'description' => '查看销售订单',
            ],
            [
                'name' => 'sales_customer_view',
                'display_name' => '销售_客户_查看',
                'description' => '查看客户',
            ],
            [
                'name' => 'purchase_pohead_view',
                'display_name' => '采购_采购订单_查看',
                'description' => '查看采购订单',
            ],
            [
                'name' => 'purchase_vendor_view',
                'display_name' => '采购_供应商_查看',
                'description' => '查看供应商',
            ],
        ]);
    }
}
