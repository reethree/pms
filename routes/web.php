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

Route::group(['middleware' => ['guest'], 'namespace' => 'Auth'], function(){

    // Login Routes
    Route::get('/login', [
        'as' => 'login',
        'uses' => 'LoginController@getLogin'
    ]);
    Route::post('/login', [
        'as' => 'login',
        'uses' => 'LoginController@postLogin'
    ]);

});

Route::group(['middleware' => ['auth']], function(){

    // Dashboard Routes
    Route::get('/', [
        'as' => 'index',
        'uses' => 'MainController@index'
    ]);
    
    // Currency Routes
    Route::get('/currency', [
        'as' => 'index-currency',
        'uses' => 'MainController@indexCurrency'
    ]);
    Route::post('/currency/update', [
        'as' => 'update-currency',
        'uses' => 'MainController@updateCurrency'
    ]);
    
    // Logout Routes
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'Auth\LoginController@logout'
    ]);
    
    // Users Management Routes   
    Route::get('/users', [
        'as' => 'index-users',
        'uses' => 'UserController@index'
    ]);
    Route::get('/users/create', [
        'as' => 'create-users',
        'uses' => 'UserController@create'
    ]);
    Route::post('/users/store', [
        'as' => 'store-users',
        'uses' => 'UserController@store'
    ]);
    Route::get('/users/edit/{id}', [
        'as' => 'edit-users',
        'uses' => 'UserController@edit'
    ]);
    Route::post('/users/update/{id}', [
        'as' => 'update-users',
        'uses' => 'UserController@update'
    ]);
    Route::get('/users/delete/{id}', [
        'as' => 'delete-users',
        'uses' => 'UserController@destroy'
    ]);
    
    // MASTER DATA ROUTES
    Route::group(['namespace' => 'Master'], function(){
        
        // Customer Routes
        Route::get('/customer', [
            'as' => 'index-customer',
            'uses' => 'CustomerController@index'
        ]);
        Route::get('/customer/get', [
            'as' => 'getCustomerTable',
            'uses' => 'CustomerController@getTable'
        ]);
        Route::get('/customer/create', [
            'as' => 'create-customer',
            'uses' => 'CustomerController@create'
        ]);
        Route::post('/customer/store', [
            'as' => 'store-customer',
            'uses' => 'CustomerController@store'
        ]);
        Route::get('/customer/edit/{id}', [
            'as' => 'edit-customer',
            'uses' => 'CustomerController@edit'
        ]);
        Route::post('/customer/update/{id}', [
            'as' => 'update-customer',
            'uses' => 'CustomerController@update'
        ]);
        Route::get('/customer/delete/{id}', [
            'as' => 'delete-customer',
            'uses' => 'CustomerController@destroy'
        ]);
        
        // Fees Routes
        Route::get('/fees', [
            'as' => 'index-fees',
            'uses' => 'FeesController@index'
        ]);
        Route::get('/fees/create', [
            'as' => 'create-fees',
            'uses' => 'FeesController@create'
        ]);
        Route::post('/fees/store', [
            'as' => 'store-fees',
            'uses' => 'FeesController@store'
        ]);
        Route::get('/fees/edit/{id}', [
            'as' => 'edit-fees',
            'uses' => 'FeesController@edit'
        ]);
        Route::post('/fees/update/{id}', [
            'as' => 'update-fees',
            'uses' => 'FeesController@update'
        ]);
        Route::get('/fees/delete/{id}', [
            'as' => 'delete-fees',
            'uses' => 'FeesController@destroy'
        ]);
        Route::get('/fees/getDataOverheadByYear', [
            'as' => 'getDataOverheadByYear',
            'uses' => 'FeesController@getDataOverheadByYear'
        ]);
        
        // Machine Routes
        Route::get('/machine', [
            'as' => 'index-machine',
            'uses' => 'MachineController@index'
        ]);
        Route::get('/machine/get', [
            'as' => 'getMachineTable',
            'uses' => 'MachineController@getTable'
        ]);
        Route::get('/machine/create', [
            'as' => 'create-machine',
            'uses' => 'MachineController@create'
        ]);
        Route::post('/machine/store', [
            'as' => 'store-machine',
            'uses' => 'MachineController@store'
        ]);
        Route::get('/machine/edit/{id}', [
            'as' => 'edit-machine',
            'uses' => 'MachineController@edit'
        ]);
        Route::post('/machine/update/{id}', [
            'as' => 'update-machine',
            'uses' => 'MachineController@update'
        ]);
        Route::get('/machine/delete/{id}', [
            'as' => 'delete-machine',
            'uses' => 'MachineController@destroy'
        ]);

        // Mould Routes
        Route::get('/mould', [
            'as' => 'index-mould',
            'uses' => 'MouldController@index'
        ]);
        Route::get('/mould/get', [
            'as' => 'getMouldTable',
            'uses' => 'MouldController@getTable'
        ]);
        Route::get('/mould/create', [
            'as' => 'create-mould',
            'uses' => 'MouldController@create'
        ]);
        Route::post('/mould/store', [
            'as' => 'store-mould',
            'uses' => 'MouldController@store'
        ]);
        Route::get('/mould/edit/{id}', [
            'as' => 'edit-mould',
            'uses' => 'MouldController@edit'
        ]);
        Route::post('/mould/update/{id}', [
            'as' => 'update-mould',
            'uses' => 'MouldController@update'
        ]);
        Route::get('/mould/delete/{id}', [
            'as' => 'delete-mould',
            'uses' => 'MouldController@destroy'
        ]);

        // Material Routes
        Route::get('/material', [
            'as' => 'index-material',
            'uses' => 'MaterialController@index'
        ]);
        Route::get('/material/get', [
            'as' => 'getMaterialTable',
            'uses' => 'MaterialController@getTable'
        ]);
        Route::get('/material/create', [
            'as' => 'create-material',
            'uses' => 'MaterialController@create'
        ]);
        Route::post('/material/store', [
            'as' => 'store-material',
            'uses' => 'MaterialController@store'
        ]);
        Route::post('/material/store/type', [
            'as' => 'store-material-type',
            'uses' => 'MaterialController@storeType'
        ]);
        Route::get('/material/edit/{id}', [
            'as' => 'edit-material',
            'uses' => 'MaterialController@edit'
        ]);
        Route::post('/material/update/{id}', [
            'as' => 'update-material',
            'uses' => 'MaterialController@update'
        ]);
        Route::get('/material/delete/{id}', [
            'as' => 'delete-material',
            'uses' => 'MaterialController@destroy'
        ]);
        
        Route::get('/material/group', [
            'as' => 'index-material-group',
            'uses' => 'MaterialController@indexGroup'
        ]);
        Route::get('/material/group/get', [
            'as' => 'getMaterialGroupTable',
            'uses' => 'MaterialController@getGroupTable'
        ]);
        Route::get('/material/group/create', [
            'as' => 'create-material-group',
            'uses' => 'MaterialController@createGroup'
        ]);
        Route::post('/material/group/store', [
            'as' => 'store-material-group',
            'uses' => 'MaterialController@storeGroup'
        ]);
        Route::get('/material/group/edit/{id}', [
            'as' => 'edit-material-group',
            'uses' => 'MaterialController@editGroup'
        ]);
        Route::post('/material/group/update/{id}', [
            'as' => 'update-material-group',
            'uses' => 'MaterialController@updateGroup'
        ]);
        Route::get('/material/group/delete/{id}', [
            'as' => 'delete-material-group',
            'uses' => 'MaterialController@destroyGroup'
        ]);
        Route::post('/material/group/detail/update/{group_id}', [
            'as' => 'update-material-group-detail',
            'uses' => 'MaterialController@updateGroupDetail'
        ]);
        Route::get('/material/group/detail/delete/{detail_id}', [
            'as' => 'delete-material-group-detail',
            'uses' => 'MaterialController@destroyGroupDetail'
        ]);
        Route::post('/material/group/loadGroup/{product_id}', [
            'as' => 'load-material-group',
            'uses' => 'MaterialController@loadGroupMaterial'
        ]);
        Route::post('/material/group/saveGroupMaterial/{product_id}', [
            'as' => 'saveGroupMaterial',
            'uses' => 'MaterialController@saveGroupMaterial'
        ]);
        
        // Electricity Routes
        Route::get('/electricity', [
            'as' => 'index-electricity',
            'uses' => 'ElectricityController@index'
        ]);
        Route::get('/electricity/create', [
            'as' => 'create-electricity',
            'uses' => 'ElectricityController@create'
        ]);
        Route::post('/electricity/store', [
            'as' => 'store-electricity',
            'uses' => 'ElectricityController@store'
        ]);
        Route::get('/electricity/edit/{id}', [
            'as' => 'edit-electricity',
            'uses' => 'ElectricityController@edit'
        ]);
        Route::post('/electricity/update/{id}', [
            'as' => 'update-electricity',
            'uses' => 'ElectricityController@update'
        ]);
        Route::get('/electricity/delete/{id}', [
            'as' => 'delete-electricity',
            'uses' => 'ElectricityController@destroy'
        ]);
        Route::get('/electricity/getDataElectricityByYear', [
            'as' => 'getDataElectricityByYear',
            'uses' => 'ElectricityController@getDataElectricityByYear'
        ]);
        
        // Labour Routes
        Route::get('/labour', [
            'as' => 'index-labour',
            'uses' => 'LabourController@index'
        ]);
        Route::get('/labour/create', [
            'as' => 'create-labour',
            'uses' => 'LabourController@create'
        ]);
        Route::post('/labour/store', [
            'as' => 'store-labour',
            'uses' => 'LabourController@store'
        ]);
        Route::get('/labour/edit/{id}', [
            'as' => 'edit-labour',
            'uses' => 'LabourController@edit'
        ]);
        Route::post('/labour/update/{id}', [
            'as' => 'update-labour',
            'uses' => 'LabourController@update'
        ]);
        Route::get('/labour/delete/{id}', [
            'as' => 'delete-labour',
            'uses' => 'LabourController@destroy'
        ]);
        Route::get('/labour/getDataLabourByYear', [
            'as' => 'getDataLabourByYear',
            'uses' => 'LabourController@getDataLabourByYear'
        ]);

        
    });
    
    
    // MAIN DATA ROUTES
    Route::group(['namespace' => 'Main'], function(){
        
        // Order Routes
        Route::get('/order', [
            'as' => 'index-order',
            'uses' => 'OrderController@index'
        ]);
        Route::get('/order/get', [
            'as' => 'getOrderTable',
            'uses' => 'OrderController@getTable'
        ]);
        Route::get('/order/create', [
            'as' => 'create-order',
            'uses' => 'OrderController@create'
        ]);
        Route::post('/order/store', [
            'as' => 'store-order',
            'uses' => 'OrderController@store'
        ]);
        Route::get('/order/edit/{id}', [
            'as' => 'edit-order',
            'uses' => 'OrderController@edit'
        ]);
        Route::post('/order/update/{id}', [
            'as' => 'update-order',
            'uses' => 'OrderController@update'
        ]);
        Route::get('/order/delete/{id}', [
            'as' => 'delete-order',
            'uses' => 'OrderController@destroy'
        ]);
        Route::post('/order/detail/update/{order_id}/{type}', [
            'as' => 'update-order-detail',
            'uses' => 'OrderController@updateDetail'
        ]);
        Route::get('/order/detail/delete/{detail_id}/{type}', [
            'as' => 'delete-order-detail',
            'uses' => 'OrderController@destroyDetail'
        ]);
        Route::get('/order/preview/{id}', [
            'as' => 'preview-order',
            'uses' => 'OrderController@preview'
        ]);
        Route::get('/order/preview/send-email/{id}', [
            'as' => 'send-email-order',
            'uses' => 'OrderController@sendEmail'
        ]);

        // Product Routes
        Route::get('/product', [
            'as' => 'index-product',
            'uses' => 'ProductController@index'
        ]);
        Route::get('/product/get', [
            'as' => 'getProductTable',
            'uses' => 'ProductController@getTable'
        ]);
        Route::get('/product/create', [
            'as' => 'create-product',
            'uses' => 'ProductController@create'
        ]);
        Route::post('/product/store', [
            'as' => 'store-product',
            'uses' => 'ProductController@store'
        ]);
        Route::get('/product/edit/{id}', [
            'as' => 'edit-product',
            'uses' => 'ProductController@edit'
        ]);
        Route::post('/product/update/{id}', [
            'as' => 'update-product',
            'uses' => 'ProductController@update'
        ]);
        Route::post('/product/detail/update/{product_id}/{type}', [
            'as' => 'update-product-detail',
            'uses' => 'ProductController@updateDetail'
        ]);
        Route::get('/product/delete/{id}', [
            'as' => 'delete-product',
            'uses' => 'ProductController@destroy'
        ]);
        Route::get('/product/detail/delete/{detail_id}/{type}', [
            'as' => 'delete-product-detail',
            'uses' => 'ProductController@destroyDetail'
        ]);
        
        // Calculation Routes
        Route::get('/calculation', [
            'as' => 'index-calculation',
            'uses' => 'CalculationController@index'
        ]);        
        
    });

});
