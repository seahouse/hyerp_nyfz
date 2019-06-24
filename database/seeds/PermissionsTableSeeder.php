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
        ]);
    }
}
