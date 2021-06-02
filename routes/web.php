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

function ComponentLeafs(App\Models\Component $component)
    {
        $leafs = [];
        $stack =  [];
        array_push($stack,$component);
        
        while(!empty($stack)){
            $c = array_pop($stack);
            
            $children = $c->children;
            
            if($children->isEmpty()){
                $leafs[] = $c;
            }else{
                foreach ($children as $child) {
                     array_push($stack,$child);
                } 
            }
        }
        return $leafs;
    }

 Route::get('test', function(){
     $categories = App\Models\Category::all();
     $temp = [];
     $comp = [];
     foreach($categories as $category){
         $comp[$category->name] = [];
         foreach($category->components as $component){
            $name = $component->name;
            $count = count(ComponentLeafs($component));
            if(!isset($temp[$name])){
                $temp[$name] = $count;
            }
            
            $comp[$category->name][] = ['name' => $name, 'count' => $temp[$name]];
         }
     }
     
     return [$comp,$temp];
 });


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    
    Route::group(['as' => 'voyager.'], function () {
        //Cloud Provider Routes
        $namespacePrefix = 'App\\Http\\Controllers\\Voyager\\';
        
        Route::group([
            'as'     => 'template.',
            'prefix' => 'template/{component}',
        ], function () use ($namespacePrefix) {
            Route::get('builder', ['uses' => $namespacePrefix.'TemplateController@builder',    'as' => 'builder']);
            Route::post('add', ['uses' => $namespacePrefix.'TemplateController@add_item', 'as' => 'add_item']);
            Route::post('order', ['uses' => $namespacePrefix.'TemplateController@order_item', 'as' => 'order_item']);
            Route::delete('', ['uses' => $namespacePrefix.'TemplateController@delete_item', 'as' => 'delete_item']);
        });
        
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


