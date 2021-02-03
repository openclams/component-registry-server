<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function index()
    {  
        return Provider::all()->map(function ($provider, $key) {
            
            $result = [
                "target" => $provider->target,
		"title" => $provider->title,
		"company" => $provider->company,
                "categoryListUrl" => route('categoryList', ['provider' => $provider->id]),
                "componentUrl" => route('component'), 
                "edgesUrl" => route('edges'),
		"image" => $provider->image, 
                "regions" => $provider->regions->toArray()
            ];
            return $result;
        });
    }
    
    public function categories(Provider $provider)
    {
        return $provider->categories->toArray();
    }
    
    public function images(Provider $provider, string $imageName){
        return response()->file($provider->target.'/'.$imageName);
    }
}
