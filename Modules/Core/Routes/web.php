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

Route::prefix('core/')->middleware(['auth', 'access:CORE-MEGAPPOLIS'])->group(function() {
    Route::get('/', 'HomeController@index')->name('core');

    Route::get('/app/data', 'AppController@data')->name('core.app.data');
    Route::get('/app/index', 'AppController@index')->name('core.app.index');
    Route::get('/app/register', 'AppController@create')->name('core.app.create');
    Route::post('/app/register', 'AppController@store')->name('core.app.store');
    Route::get('/app/register/{app}', 'AppController@edit')->name('core.app.edit');
    Route::put('/app/register/{app}', 'AppController@update')->name('core.app.update');
    Route::post('/app/approve/{app}', 'AppController@approve')->name('core.app.approve');
    Route::post('/app/reject/{app}', 'AppController@reject')->name('core.app.reject');

    Route::get('/module/index', 'ModuleController@index')->name('core.module.index');
    Route::get('/module/register', 'ModuleController@create')->name('core.module.create');
    Route::post('/module/register', 'ModuleController@store')->name('core.module.store');
    Route::get('/module/register/{module}', 'ModuleController@edit')->name('core.module.edit');
    Route::put('/module/register/{module}', 'ModuleController@update')->name('core.module.update');
    Route::get('/module/data/', 'ModuleController@data')->name('core.page.data');

    Route::get('/people/index', 'PeopleController@index')->name('core.people.index');
    Route::get('/people/register', 'PeopleController@create')->name('core.people.create');
    Route::post('/people/register', 'PeopleController@store')->name('core.people.store');
    Route::get('/people/register/{page}', 'PeopleController@edit')->name('core.people.edit');
    Route::put('/people/register/{page}', 'PeopleController@update')->name('core.people.update');

    Route::get('/permission/data', 'PermissionController@data')->name('core.permission.data');
    Route::get('/permission/index', 'PermissionController@index')->name('core.permission.index');
    Route::get('/permission/register', 'PermissionController@create')->name('core.permission.create');
    Route::post('/permission/register', 'PermissionController@store')->name('core.permission.store');
    Route::get('/permission/register/{permission}', 'PermissionController@edit')->name('core.permission.edit');
    Route::put('/permission/register/{permission}', 'PermissionController@update')->name('core.permission.update');

    Route::get('/role/data', 'RoleController@data')->name('core.role.data');
    Route::get('/role/index', 'RoleController@index')->name('core.role.index');
    Route::get('/role/register', 'RoleController@create')->name('core.role.create');
    Route::post('/role/register', 'RoleController@store')->name('core.role.store');
    Route::get('/role/register/{role}', 'RoleController@edit')->name('core.role.edit');
    Route::put('/role/register/{role}', 'RoleController@update')->name('core.role.update');
    Route::get('/role/user/{role} ', 'RoleController@user')->name('core.role.user');
    Route::get('/role/user-page-permissions/{role}', 'RoleController@show')->name('core.role.show');

    Route::get('/user/data', 'UserController@data')->name('core.user.data');
    Route::get('/user/index', 'UserController@index')->name('core.user.index');
    Route::get('/user/register', 'UserController@create')->name('core.user.create');
    Route::post('/user/register', 'UserController@store')->name('core.user.store');
    Route::get('/user/register/{user}', 'UserController@edit')->name('core.user.edit');
    Route::put('/user/register/{user}', 'UserController@update')->name('core.user.update');
});