<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\EdgeController;
use Illuminate\Support\Facades\DB;
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

//Route::get('/test', function (Request $request) {
//    $a = \App\Models\Attribute::all();
//    $i = 1;
//    foreach($a as $b){
//        $affected = DB::table('attributes')
//              ->where('id_name', $b->id_name)
//              ->where('attributable_id', $b->attributable_id)
//              ->update(['id' => $i++]);
//    }    
//    return [];
//})->name('test');

Route::get('/test', function (Request $request) {
   
    $total_edges = DB::table('edge_constraints')
                ->select('edge_id')
                ->whereIn('from_component_id', [2])
                ->whereIn('to_component_id', [2])
                ->where('type','Allow')
                ->groupBy('edge_id')
                ->get()
                ->map(function($e){return $e->edge_id;});
     
    $no_edges = DB::table('edge_constraints')
                ->select('edge_id')
                ->whereIn('edge_id', $total_edges)
                ->where('from_component_id', 2)
                ->where('to_component_id', 4)
                ->where('type','Exclude')
                ->groupBy('edge_id')
                ->get()
                ->map(function($e){return $e->edge_id;});

                
    $edges = array_diff($total_edges, $no_edges);         
    
    return Edge::find($edges);
})->name('test');

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
