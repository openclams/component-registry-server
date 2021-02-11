<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\EdgeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Load all providers
 */
Route::get('/providers',[ProviderController::class, 'index']); 

/**
 * Load all categories
 */
Route::get('/provider/{provider}/categories',[ProviderController::class, 'categories'])->name("categoryList"); 

/**
 * Load component icon
 */
Route::get('/provider/{provider}/images/{name}',[ProviderController::class, 'images'])->name("image"); 

/**
 * Load cost lookup table of one component
 */
Route::get('/component/{component}/costs',[ComponentController::class, 'costs']); 

/**
 * Load the parents of a component 
 */
Route::get('/component/{component}/parents',[ComponentController::class, 'parents']); 

/**
 * Load the children of a component 
 */
Route::get('/component/{component}/children',[ComponentController::class, 'children']); 

/**
 * Load a component
 */
Route::get('/component/{component}',[ComponentController::class, 'index']); 
Route::get('/component',function(){return Null;})->name("component"); // just used for the provider controller


/**
 * Load edge types
 */
Route::get('/edge/{fromComponent}/{toComponent}',[EdgeController::class, 'index']); // just used for the provider controller
Route::get('/edge',function(){return Null;})->name("edges"); // just used for the provider controller
