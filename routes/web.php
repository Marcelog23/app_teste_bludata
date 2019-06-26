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

Route::group(['middleware' => 'auth'], function (){

  Route::get('/home', 'HomeController@index')->name('home');

  Route::group(['prefix' => 'empresa'], function () {
    Route::any('',              ['as'=>'empresa',         'uses'=>'EmpresaController@index']);
    Route::get('create',        ['as'=>'empresa.create',  'uses'=>'EmpresaController@create']);
    Route::get('{id}/destroy',  ['as'=>'empresa.destroy', 'uses'=>'EmpresaController@destroy']);
    Route::get('{id}/edit',     ['as'=>'empresa.edit',    'uses'=>'EmpresaController@edit']);
    Route::put('{id}/update',   ['as'=>'empresa.update',  'uses'=>'EmpresaController@update']);
    Route::post('store',        ['as'=>'empresa.store',   'uses'=>'EmpresaController@store']);
  });

  Route::group(['prefix' => 'fornecedor'], function () {
    Route::any('',              ['as'=>'fornecedor',         'uses'=>'FornecedorController@index']);
    Route::get('create',        ['as'=>'fornecedor.create',  'uses'=>'FornecedorController@create']);
    Route::get('{id}/destroy',  ['as'=>'fornecedor.destroy', 'uses'=>'FornecedorController@destroy']);
    Route::get('{id}/edit',     ['as'=>'fornecedor.edit',    'uses'=>'FornecedorController@edit']);
    Route::put('{id}/update',   ['as'=>'fornecedor.update',  'uses'=>'FornecedorController@update']);
    Route::post('store',        ['as'=>'fornecedor.store',   'uses'=>'FornecedorController@store']);
    Route::get('{id}/getUF',    ['as'=>'fornecedor.getUF',   'uses'=>'EmpresaController@getUfEmpresa']);

  });
});

