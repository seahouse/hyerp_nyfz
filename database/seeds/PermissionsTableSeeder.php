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
//            [
//                'name' => 'module_basic',
//                'display_name' => '基础资料',
//                'description' => '基础资料菜单',
//            ],
//            [
//                'name' => 'module_inventory',
//                'display_name' => '库存',
//                'description' => '库存菜单',
//            ],
//            [
//                'name' => 'module_sales',
//                'display_name' => '销售',
//                'description' => '销售菜单',
//            ],
//            [
//                'name' => 'module_purchase',
//                'display_name' => '采购',
//                'description' => '采购菜单',
//            ],
//            [
//                'name' => 'module_system',
//                'display_name' => '系统',
//                'description' => '系统菜单',
//            ],

            [
                'name' => 'basic_metrial_edit',
                'display_name' => '基础资料_物料_编辑',
                'description' => '编辑物料',
            ],
//            [
//                'name' => 'basic_metrial_view',
//                'display_name' => '基础资料_物料_查看',
//                'description' => '查看物料',
//            ],

            [
                'name' => 'inventory_warehouse_edit',
                'display_name' => '库存_仓库_编辑',
                'description' => '编辑仓库',
            ],
//            [
//                'name' => 'inventory_warehouse_view',
//                'display_name' => '库存_仓库_查看',
//                'description' => '查看仓库',
//            ],

            [
                'name' => 'sales_sohead_edit',
                'display_name' => '销售_销售订单_编辑',
                'description' => '编辑销售订单',
            ],
//            [
//                'name' => 'sales_sohead_view',
//                'display_name' => '销售_销售订单_查看',
//                'description' => '查看销售订单',
//            ],
            [
                'name' => 'sales_customer_edit',
                'display_name' => '销售_客户_编辑',
                'description' => '编辑客户',
            ],
//            [
//                'name' => 'sales_customer_view',
//                'display_name' => '销售_客户_查看',
//                'description' => '查看客户',
//            ],

            [
                'name' => 'purchase_pohead_edit',
                'display_name' => '采购_采购订单_编辑',
                'description' => '编辑采购订单',
            ],
//            [
//                'name' => 'purchase_pohead_view',
//                'display_name' => '采购_采购订单_查看',
//                'description' => '查看采购订单',
//            ],
            [
                'name' => 'purchase_vendor_edit',
                'display_name' => '采购_供应商_编辑',
                'description' => '编辑供应商',
            ],
//            [
//                'name' => 'purchase_vendor_view',
//                'display_name' => '采购_供应商_查看',
//                'description' => '查看供应商',
//            ],
        ]);
    }
}
