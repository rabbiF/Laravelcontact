<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a bien which
| contains the "web" middleware bien. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');    
   
    Route::post('/biens', [
        'uses' => 'BienController@store',
        'as' => 'biens'
    ]);

    Route::get('/bien/show/{bien}', [
        'uses' => 'BienController@show',
        'as' => 'bien.show'
    ]);

    Route::get('/bien/edit/{bien}', [
        'uses' => 'BienController@edit',
        'as' => 'bien.edit'
    ]);

    Route::post('/bien/update/{bien}', [
        'uses' => 'BienController@update',
        'as' => 'bien.update'
    ]);

    Route::get('/bien/delete/{bien}', [
        'uses' => 'BienController@destroy',
        'as' => 'bien.delete'
    ]);

    Route::get('/clients', [
        'uses' => 'ClientController@index',
        'as' => 'clients'
    ]);

    Route::get('/client/edit/{client}', [
        'uses' => 'ClientController@edit',
        'as' => 'client.edit'
    ]);

    Route::get('/client/show/{client}', [
        'uses' => 'ClientController@show',
        'as' => 'client.show'
    ]);

    Route::get('/client/delete/{client}', [
        'uses' => 'ClientController@destroy',
        'as' => 'client.delete'
    ]);

    Route::post('/clients', [
        'uses' => 'ClientController@store',
        'as' => 'client.store'
    ]);

    Route::post('/client/update/{client}', [
        'uses' => 'ClientController@update',
        'as' => 'client.update'
    ]);

    Route::get('/search', 'ClientController@search')->name('client.search');

    Route::get('/tasks', 'ClientController@download')->name('client.download');

    Route::get('/admin', [
        'uses' => 'AdminController@index',
        'as' => 'admin'
    ]);

    Route::get('/admin/edit/{user}', [
        'uses' => 'AdminController@edit',
        'as' => 'admin.edit'
    ]);    

    Route::get('/admin/delete/{user}', [
        'uses' => 'AdminController@destroy',
        'as' => 'admin.delete'
    ]);

    Route::post('/admin', [
        'uses' => 'AdminController@store',
        'as' => 'admin.store'
    ]);

    Route::post('/admin/update/{user}', [
        'uses' => 'AdminController@update',
        'as' => 'admin.update'
    ]);   

    Route::get('/clientsAll', 'AdminController@clientsAll');

    Route::get('/exports', 'AdminController@download');
});
