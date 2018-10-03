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

Route::get('/admin', 'AdminLoginController@login');
Route::get('/admin/login', 'AdminLoginController@login');
Route::post('/admin/authenticate', 'AdminLoginController@authenticate');
Route::get('/logout', 'AdminLoginController@logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('dashboard','DashboardController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('list','UserController@index')->name('admin.user.list')->middleware(['permission:manage_user']);
        Route::get('create','UserController@create')->name('admin.user.create')->middleware(['permission:add_user']);
        Route::post('store','UserController@store')->name('admin.user.store');
        Route::get('edit/{id}','UserController@edit')->name('admin.user.edit')->middleware(['permission:edit_user']);
        Route::put('update','UserController@update')->name('admin.user.update');
        Route::delete('delete','UserController@destroy')->name('admin.user.delete')->middleware(['permission:delete_user']);
    });

    Route::group(['prefix' => 'catalog'], function () {
        Route::get('list','CatalogController@list')->name('admin.catalog.list');
        Route::get('create/{parent_id?}','CatalogController@create')->name('admin.catalog.create');
        Route::post('store','CatalogController@store')->name('admin.catalog.store');
        Route::get('edit/{id}','CatalogController@edit')->name('admin.catalog.edit');
        Route::put('update','CatalogController@update')->name('admin.catalog.update');
        Route::get('delete/{id}','CatalogController@destroy')->name('admin.catalog.delete');
    });

    Route::group(['prefix' => 'links'], function () {
        Route::get('list','LinksController@list')->name('admin.links.list');
        Route::get('create','LinksController@create')->name('admin.links.create');
        Route::post('store','LinksController@store')->name('admin.links.store');
        Route::get('edit/{id}','LinksController@edit')->name('admin.links.edit');
        Route::put('update','LinksController@update')->name('admin.links.update');
        Route::delete('delete','LinksController@destroy')->name('admin.links.delete');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('list','RoleController@list')->name('admin.role.list')->middleware(['permission:manage_role']);
        Route::get('create','RoleController@create')->name('admin.role.create')->middleware(['permission:add_role']);
        Route::post('save','RoleController@store')->name('admin.role.store');
        Route::get('edit/{id}','RoleController@edit')->name('admin.role.edit')->middleware(['permission:edit_role']);
        Route::put('update','RoleController@update')->name('admin.role.update');
        Route::delete('delete/{id}','RoleController@destroy')->name('admin.role.delete')->middleware(['permission:delete_role']);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('list','SettingsController@list')->name('admin.settings.list');
        Route::post('store', 'SettingsController@store')->name('admin.settings.store');
        Route::get('create/{type}', 'SettingsController@createForm')->name('admin.settings.createform');;
        Route::get('download/{settings}', 'SettingsController@fileDownload')->name('admin.settings.download');
        Route::get('create', 'SettingsController@create')->name('admin.settings.create');
        Route::get('edit/{id}', 'SettingsController@edit')->name('admin.settings.edit');
        Route::put('update/{id}', 'SettingsController@update')->name('admin.settings.update');
        Route::delete('delete/{id}', 'SettingsController@destroy')->name('admin.settings.delete');
    });

    Route::group(['prefix' => 'datatable'], function () {
        Route::any('users', 'DataTableController@getUsers')->name('admin.datatable.users');
        Route::any('role', 'DataTableController@getRole')->name('admin.datatable.role');
        Route::any('links', 'DataTableController@getLinks')->name('admin.datatable.links');
        Route::any('settings', 'DataTableController@getSettings')->name('admin.datatable.settings');
    });

});
