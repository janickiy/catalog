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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

//////////ADMIN PANEL////////////////

Route::get('/admin', 'Admin\AdminLoginController@login');
Route::get('/admin/login', 'Admin\AdminLoginController@login');
Route::post('/admin/authenticate', 'Admin\AdminLoginController@authenticate');
Route::get('/logout', 'Admin\AdminLoginController@logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('list','Admin\UserController@index')->name('admin.user.list')->middleware(['permission:manage_user']);
        Route::get('create','Admin\UserController@create')->name('admin.user.create')->middleware(['permission:add_user']);
        Route::post('store','Admin\UserController@store')->name('admin.user.store')->middleware(['permission:add_user']);
        Route::get('edit/{id}','Admin\UserController@edit')->name('admin.user.edit')->middleware(['permission:edit_user']);
        Route::put('update','Admin\UserController@update')->name('admin.user.update')->middleware(['permission:edit_user']);
        Route::delete('delete/{id}','Admin\UserController@destroy')->name('admin.user.delete')->middleware(['permission:delete_user']);
    });

    Route::group(['prefix' => 'catalog'], function () {
        Route::get('list','Admin\CatalogController@list')->name('admin.catalog.list');
        Route::get('create/{parent_id?}','Admin\CatalogController@create')->name('admin.catalog.create');
        Route::post('store','Admin\CatalogController@store')->name('admin.catalog.store');
        Route::get('edit/{id}','Admin\CatalogController@edit')->name('admin.catalog.edit');
        Route::put('update','Admin\CatalogController@update')->name('admin.catalog.update');
        Route::get('delete/{id}','Admin\CatalogController@destroy')->name('admin.catalog.delete');
    });

    Route::group(['prefix' => 'links'], function () {
        Route::get('list','Admin\LinksController@list')->name('admin.links.list');
        Route::get('create','Admin\LinksController@create')->name('admin.links.create');
        Route::post('store','Admin\LinksController@store')->name('admin.links.store');
        Route::get('edit/{id}','Admin\LinksController@edit')->name('admin.links.edit');
        Route::put('update','Admin\LinksController@update')->name('admin.links.update');
        Route::delete('delete/{id}','Admin\LinksController@destroy')->name('admin.links.delete');
        Route::get('import','Admin\LinksController@importForm')->name('admin.links.import');
        Route::post('importLink','Admin\LinksController@import')->name('admin.links.importlink');
        Route::get('export','Admin\LinksController@export')->name('admin.links.export');

    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('list','Admin\RoleController@list')->name('admin.role.list')->middleware(['permission:manage_role']);
        Route::get('create','Admin\RoleController@create')->name('admin.role.create')->middleware(['permission:add_role']);
        Route::post('save','Admin\RoleController@store')->name('admin.role.store');
        Route::get('edit/{id}','Admin\RoleController@edit')->name('admin.role.edit')->middleware(['permission:edit_role']);
        Route::put('update','Admin\RoleController@update')->name('admin.role.update');
        Route::delete('delete/{id}','Admin\RoleController@destroy')->name('admin.role.delete')->middleware(['permission:delete_role']);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('list','Admin\SettingsController@list')->name('admin.settings.list');
        Route::post('store', 'Admin\SettingsController@store')->name('admin.settings.store');
        Route::get('create/{type}', 'Admin\SettingsController@createForm')->name('admin.settings.createform');;
        Route::get('download/{settings}', 'Admin\SettingsController@fileDownload')->name('admin.settings.download');
        Route::get('create', 'Admin\SettingsController@create')->name('admin.settings.create');
        Route::get('edit/{id}', 'Admin\SettingsController@edit')->name('admin.settings.edit');
        Route::put('update/{id}', 'Admin\SettingsController@update')->name('admin.settings.update');
        Route::delete('delete/{id}', 'Admin\SettingsController@destroy')->name('admin.settings.delete');
    });

    Route::group(['prefix' => 'datatable'], function () {
        Route::any('users', 'Admin\DataTableController@getUsers')->name('admin.datatable.users');
        Route::any('role', 'Admin\DataTableController@getRole')->name('admin.datatable.role');
        Route::any('links', 'Admin\DataTableController@getLinks')->name('admin.datatable.links');
        Route::any('settings', 'Admin\DataTableController@getSettings')->name('admin.datatable.settings');
    });

});
