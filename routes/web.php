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
Route::get('/roles', function () {
    return view('Roles');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('roles/store','RoleController@store')->name('roles/store');
Route::get('permiso','PermissionController@index')->name('permiso');
Route::get('permisos/view','PermissionController@view')->name('permisos/view');
Route::post('permisos/create','PermissionController@create')->name('permisos/create');
Route::get('permisos/obtener','PermissionController@obtener')->name('permisos/obtener');

Route::resource('role','RoleController',['except'=>'show']);


