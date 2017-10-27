<?php
// 	Route::get('admin', ['as' => 'home','middleware' => 'auth', function () {

		
// 		return view('home');
// 	}]);

	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('captcha/{tmp}', 'Auth\AuthController@captcha');
	
	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

    //Route::get('home', 'BackManage\HomeController@HomeList',['as' => 'home','middleware' => 'auth']);
    
	

	
	
	
	
	Route::group(['namespace' => 'BackManage' ,'middleware'=> ['auth']], function () {
		
		Route::get('admin', 'HomeController@HomeList');

		Route::Post('ajax/citylist', 'AjaxController@cityList');
		Route::Post('ajax/getuserinfo', 'AjaxController@getUserInfo');
		
		//供应商
		Route::get('supplierlist', 'SupplierController@supplierList');
		Route::get('supplieredit/{id}', 'SupplierController@supplierEdit');
		Route::Post('suppliersave', 'SupplierController@supplierSave');
		Route::get('supplieradd', 'SupplierController@supplierAdd');
		Route::Post('suppliercreate', 'SupplierController@supplierCreate');
		Route::get('supplierdelete/{id}', 'SupplierController@supplierDelete');
		//商品
        Route::get('goodslist', 'GoodsController@Goodslist');//商品列表
        Route::get('goods/goodsadd', 'GoodsController@Goodsadd');//添加商品
        Route::post('goods/store', 'GoodsController@Store');//提交商品
        Route::get('goods/edit/{id}', 'GoodsController@Edit');//编辑商品
        Route::post('goods/goodssave', 'GoodsController@Goodssave');//编辑商品保存
        Route::get('goods/goodsdel/{id}', 'GoodsController@Goodsdel');//删除商品
		

    });
	

// 		Route::group(['namespace' => 'BackManage', 'middleware'=> ['auth']], function () {
		
// 		Route::get('testsupplier', 'SupplierController@test');
		
		
		
// 		});	
	
	
	




