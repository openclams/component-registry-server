<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    
    Route::group(['as' => 'voyager.'], function () {
        //Cloud Provider Routes
        $namespacePrefix = 'App\\Http\\Controllers\\Voyager\\';
    
        Route::group([
            'as'     => 'providers.',
            'prefix' => 'providers/{provider}',
        ], function () use ($namespacePrefix) {
            Route::get('builder', ['uses' => $namespacePrefix.'ProviderController@builder',    'as' => 'builder']);
            Route::post('order', ['uses' => $namespacePrefix.'ProviderController@order_item', 'as' => 'order_item']);

            Route::group([
                'as'     => 'item.',
                'prefix' => 'item',
            ], function () use ($namespacePrefix) {
                Route::delete('{component}', ['uses' => $namespacePrefix.'ProviderController@delete_item', 'as' => 'destroy']);
                Route::post('/', ['uses' => $namespacePrefix.'ProviderController@add_item',    'as' => 'add']);
                Route::put('/', ['uses' => $namespacePrefix.'ProviderController@update_item', 'as' => 'update']);
            });
        });
    });
});


