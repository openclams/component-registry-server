<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Component;

class ComponentController extends Controller
{
    
    public function index(Component $component)
    {
        return $component->toArray();
    }
    
    public function costs(Component $component)
    {
        $result = [
            "costTable" => [
                [
                    "id" =>  $component->id,
                    "regions" => $component->costs()->get()->toArray()
                ]
            ]
        ];
        return $result; 
    }
    
    public function parents(Component $component)
    {
        if(!empty($component->parent_id))
        {
            $p = Component::find($component->parent_id);
            if($p){
                return [$p];
            }
        }
        return [];
    }
    
    public function children(Component $component)
    {
        return $component->children->toArray();
    }
}
