<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('navbarerp');
////    return view('welcome');
//});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('gitpullbybat', function() { return view('gitpullbybat'); });
//Route::get('gitpullbybat', function() {
//    Log::info(getcwd());
//    exec('cd .. && git pull', $output);
//    Log::info($output);
//});

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/', function() { return view('navbarerp'); });
    Route::get('/home', function() { return view('navbarerp'); });
    Route::get('changeuser', 'HelperController@changeuser');
    Route::post('changeuser_store', 'HelperController@changeuser_store');
});

Route::group(['prefix' => 'inventory', 'namespace' => 'Inventory', 'middleware' => ['web', 'auth']], function() {
    Route::resource('warehouses', 'WarehouseController');
    Route::resource('warehouseinheads', 'WarehouseinheadController');
    Route::group(['prefix' => 'warehouseinitems'], function () {
        Route::get('getitemsbywareshouseinid/{warehouseinid}', 'WarehouseinitemController@getitemsbywareshouseinid');
    });
    Route::group(['prefix' => 'warehouseinheads/{id}'], function () {
        Route::get('detail', 'WarehouseinheadController@detail');
    });
    Route::get('warehouseinitems/{warehouseinhead_id}/create', 'WarehouseinitemController@create');
    Route::resource('warehouseinitems', 'WarehouseinitemController');

    Route::resource('warehouseoutheads', 'WarehouseoutheadController');
    Route::group(['prefix' => 'warehouseoutitems'], function () {
        Route::get('getitemsbywareshouseoutid/{warehouseoutid}', 'WarehouseoutitemController@getitemsbywareshouseoutid');
    });
    Route::group(['prefix' => 'warehouseoutheads/{id}'], function () {
        Route::get('detail', 'WarehouseoutheadController@detail');
    });
    Route::get('warehouseoutitems/{warehouseouthead_id}/create', 'WarehouseoutitemController@create');
    Route::resource('warehouseoutitems', 'WarehouseoutitemController');

});

Route::group(['prefix' => 'basic', 'namespace' => 'Basic', 'middleware' => ['web', 'auth']], function() {
    Route::group(['prefix' => 'material_cats'], function() {
        Route::get('getitemsbykey/{key}', 'Material_catController@getitemsbykey');
    });
    Route::resource('material_cats', 'Material_catController');
    Route::group(['prefix' => 'materials'], function() {
        Route::get('getitemsbykey/{key}', 'MaterialController@getitemsbykey');
    });
    Route::resource('materials', 'MaterialController');
});

Route::group(['prefix' => 'sales', 'namespace' => 'Sales', 'middleware' => ['web', 'auth']], function() {
//    Route::group(['prefix' => 'groups'], function() {
//        Route::get('{id}/mstatistics', 'GroupController@mstatistics');
//    });
//    Route::resource('groups', 'GroupController');
//    Route::group(['prefix' => 'projects'], function() {
//        Route::get('{id}/mstatistics', 'ProjectController@mstatistics');
//    });
//    Route::resource('projects', 'ProjectController');
//    Route::get('salesorders/{id}/ship', 'SalesordersController@ship');
//    Route::post('salesorders/search', 'SalesordersController@search');
    Route::group(['prefix' => 'soheads'], function() {
//        Route::get('mindex', 'SalesordersController@mindex');
//        Route::get('getitembyid/{id}', 'SalesordersController@getitembyid');
        Route::get('getitemsbykey/{key}', 'SoheadController@getitemsbykey');
//        Route::get('{id}/mstatistics', 'SalesordersController@mstatistics');
    });
    Route::resource('soheads', 'SoheadController');
//    Route::group(['prefix' => 'salesorderhx'], function() {
//        Route::post('search', 'SalesorderhxController@search');
//        Route::get('{id}/checktaxrateinput', 'SalesorderhxController@checktaxrateinput');
//        Route::get('{id}/dwgbom', 'SalesorderhxController@dwgbom');
//        Route::get('dwgbomjson', 'SalesorderhxController@dwgbomjson');
//        Route::get('dwgbomjsondetail/{id?}', 'SalesorderhxController@dwgbomjsondetail');
//    });
//    Route::resource('salesorderhx', 'SalesorderhxController');
//    Route::group(['prefix' => 'salesorders/{salesorder}/receiptpayments'], function () {
//        Route::get('/', 'ReceiptpaymentsController@index');
//        Route::get('create', 'ReceiptpaymentsController@create');
//        Route::post('store', 'ReceiptpaymentsController@store');
//        Route::delete('destroy/{receiptpayment}', 'ReceiptpaymentsController@destroy');
//    });
//    Route::resource('salesreps', 'SalesrepsController');
//    Route::resource('terms', 'TermsController');
//    Route::get('soitems/{headId}/list', 'SoitemsController@listBySoheadId');
//    Route::get('soitems/{headId}/create', 'SoitemsController@createBySoheadId');
//    Route::resource('soitems', 'SoitemsController');
    Route::group(['prefix' => 'customers'], function() {
        Route::get('getitemsbykey/{key}', 'CustomerController@getitemsbykey');
    });
    Route::resource('customers', 'CustomerController');
//    Route::get('report', '\App\Http\Controllers\System\ReportController@indexsales');
//    Route::group(['prefix' => 'report2'], function() {
//        Route::get('bonusbysalesmanager', '\App\Http\Controllers\My\MyController@bonusbysalesmanager');
//        Route::get('bonusbytechdept', '\App\Http\Controllers\My\MyController@bonusbytechdept');
//    });
//    Route::group(['prefix' => '{sohead_id}/bonuspayment'], function () {
//        Route::get('create', 'BonuspaymentController@create');
//        Route::post('store', 'BonuspaymentController@store');
//    });
});

Route::group(['prefix' => 'purchaseorderc', 'namespace' => 'Purchaseorderc', 'middleware' => ['web', 'auth']], function() {
    Route::group(['prefix' => 'purchaseordercs/{id}'], function () {
        Route::get('detail', 'PurchaseordercController@detail');
        Route::get('seperate', 'PurchaseordercController@seperate');
//        Route::get('detailjson', 'PurchaseordercController@detailjson');
//        Route::get('packing', 'PurchaseordercController@packing');
    });
    Route::resource('purchaseordercs', 'PurchaseordercController');
    Route::get('poitemcs/{headId}/create', 'PoitemcController@createByPoheadId');
    Route::resource('poitemcs', 'PoitemcController');
});

Route::group(['prefix' => 'purchase', 'namespace' => 'Purchase', 'middleware' => ['web', 'auth']], function() {
    Route::group(['prefix' => 'vendors'], function() {
        Route::get('getitemsbykey/{key}', 'VendorController@getitemsbykey');
    });
    Route::resource('vendors', 'VendorController');
//    Route::resource('vendtypes', 'VendtypesController');
//    Route::group(['prefix' => 'vendbank'], function() {
//        Route::get('getitemsbyvendid/{vendid}', 'VendbankController@getitemsbyvendid');
//    });
//    Route::resource('vendbank', 'VendbankController');
    Route::group(['prefix' => 'purchaseorders/{id}'], function () {
        Route::get('detail', 'PurchaseorderController@detail');
        Route::get('packing', 'PurchaseorderController@packing');
//        Route::get('receiving', 'PurchaseordersController@receiving');
//        Route::get('receiptorders', 'PurchaseordersController@receiptorders');
//        Route::get('poitems', 'PurchaseordersController@poitems');
//        Route::get('receiptorders_hx', 'PurchaseordersController@receiptorders_hx');
//        Route::get('edit_hx', 'PurchaseordersController@edit_hx');
//        Route::patch('update_hx', 'PurchaseordersController@update_hx');
//        Route::get('getpoheadtaxrateass_hx', 'PurchaseordersController@getpoheadtaxrateass_hx');
    });
//    Route::group(['prefix' => 'purchaseorders/{purchaseorder}/payments'], function () {
//        Route::get('/', 'PaymentsController@index');
//        Route::get('create', 'PaymentsController@create');
//        Route::post('store', 'PaymentsController@store');
//        Route::delete('destroy/{payment}', 'PaymentsController@destroy');
//
//        Route::get('create_hxold', 'PaymentsController@create_hxold');
//        Route::post('store_hxold', 'PaymentsController@store_hxold');
//    });
    Route::group(['prefix' => 'purchaseorders'], function() {
        Route::get('getitemsbyorderkey/{key?}', 'PurchaseorderController@getitemsbyorderkey');
//        Route::get('create_hx', 'PurchaseordersController@create_hx');
        Route::post('storeseperate', 'PurchaseorderController@storeseperate');
//        Route::post('search_hx', 'PurchaseordersController@search_hx');
    });
//    Route::group(['prefix' => 'poheadtaxrateass'], function() {
//        Route::get('destorybyid/{id}', 'PoheadtaxrateassController@destorybyid');       // use get for page opt.
//    });


    Route::resource('purchaseorders', 'PurchaseorderController');
    Route::group(['prefix' => 'poitems'], function () {
        Route::post('packingstore', 'PoitemController@packingstore');
        Route::get('getitemsbypoheadid/{pohead}', 'PoitemController@getitemsbypoheadid');
    });
    Route::get('poitems/{pohead}/create', 'PoitemController@create');
    Route::group(['prefix' => 'poitems/{poitem}'], function () {
        Route::get('poitemrolls', 'PoitemController@poitemrolls');
    });
    Route::resource('poitems', 'PoitemController');
    Route::group(['prefix' => 'poitemrolls'], function () {
        Route::get('getitemsbypoitem/{poitem}', 'PoitemrollController@getitemsbypoitem');
    });
    Route::resource('poitemrolls', 'PoitemrollController');
    Route::group(['prefix' => 'asns'], function () {
        Route::post('packingstore', 'AsnController@packingstore');
    });
    Route::group(['prefix' => 'asns/{id}'], function () {
        Route::get('detail', 'AsnController@detail');
        Route::get('asnshipments', 'AsnController@asnshipments');
        Route::get('labelpreprint', 'AsnController@labelpreprint');
        Route::get('export', 'AsnController@export');
    });
    Route::resource('asns', 'AsnController');
    Route::group(['prefix' => 'asnshipments/{asn_id}'], function () {
        Route::get('create', 'AsnshipmentController@create');
    });
    Route::group(['prefix' => 'asnshipments/{asnshipment}'], function () {
        Route::get('edit', 'AsnshipmentController@edit')->name('asnshipments.edit');
        Route::patch('', 'AsnshipmentController@update')->name('asnshipments.update');
        Route::delete('', 'AsnshipmentController@destroy')->name('asnshipments.destroy');
        Route::get('asnorders', 'AsnshipmentController@asnorders');
    });
    Route::group(['prefix' => 'asnshipments'], function () {
        Route::post('store', 'AsnshipmentController@store');
    });
//    Route::resource('asnshipments', 'AsnshipmentController');
    Route::group(['prefix' => 'asnorders/{asnshipment_id}'], function () {
        Route::get('create', 'AsnorderController@create');
        Route::get('asnpackagings', 'AsnorderController@asnpackagings');
    });
    Route::group(['prefix' => 'asnorders'], function () {
        Route::get('asnorderjson', 'AsnorderController@asnorderjson');
    });
    Route::resource('asnorders', 'AsnorderController');
    Route::group(['prefix' => 'asnpackagings/{asnpackaging_id}'], function () {
        Route::get('create', 'AsnpackagingController@create');
        Route::get('asnitems', 'AsnpackagingController@asnitems');
    });
    Route::group(['prefix' => 'asnpackagings'], function () {
        Route::get('asnpackagingjson/{asnorder_id?}', 'AsnpackagingController@asnpackagingjson');
    });
    Route::resource('asnpackagings', 'AsnpackagingController');
    Route::group(['prefix' => 'asnitems/{asnpackaging_id}'], function () {
        Route::get('create', 'AsnitemController@create');
    });
    Route::resource('asnitems', 'AsnitemController');
});

Route::group(['prefix' => 'shipment', 'namespace' => 'Shipment', 'middleware' => ['web', 'auth']], function() {
    Route::group(['prefix' => 'shipments'], function () {
        Route::get('import', 'ShipmentController@import');
        Route::post('importstore', 'ShipmentController@importstore');
        Route::post('search', 'ShipmentController@search');
        Route::post('export', 'ShipmentController@export');
        Route::post('exportpvh', 'ShipmentController@exportpvh');
        Route::get('downloadfile/{filename}', 'ShipmentController@downloadfile')->name('shipment.shipments.downloadfile');
    });
    Route::group(['prefix' => 'shipments/{shipment}'], function () {
        Route::get('shipmentitems', 'ShipmentController@shipmentitems');
    });
    Route::resource('shipments', 'ShipmentController');
    Route::group(['prefix' => 'shipmentitems/{shipment}'], function () {
        Route::get('create', 'ShipmentitemController@create');
    });
    Route::resource('shipmentitems', 'ShipmentitemController');
});

Route::middleware(['auth', 'web'])->namespace('System')->prefix('system')->group(function () {
    Route::group(['prefix' => 'users'], function() {
//        Route::post('updateuseroldall', 'UsersController@updateuseroldall');
        Route::post('search', 'UserController@search');              // 搜索功能
//        Route::get('getitemsbykey/{key}', 'UsersController@getitemsbykey');
    });
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::get('editpass', 'UserController@editpass');
        Route::post('updatepass', 'UserController@updatepass');
//        Route::get('google2fa', 'UsersController@google2fa');
//        Route::post('updategoogle2fa', 'UsersController@updategoogle2fa');
    });
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::post('userroles/store', 'UserroleController@store');
    Route::group(['prefix' => 'users/{user}/roles'], function () {
        Route::get('/', 'UserroleController@index');
        Route::get('create', 'UserroleController@create');
        Route::post('store', 'UserroleController@store');
        Route::delete('destroy/{role}', 'UserroleController@destroy');
    });
    Route::group(['prefix' => 'roles/{role}/permissions'], function() {
        Route::get('/', 'RolepermissionController@index');
        Route::get('create', 'RolepermissionController@create');
        Route::delete('destroy/{permission}', 'RolepermissionController@destroy');
    });
    Route::post('rolepermissions/store', 'RolepermissionController@store');
});