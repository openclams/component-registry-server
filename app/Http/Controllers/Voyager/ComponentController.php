<?php
namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;

class ComponentController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function update(Request $request, $id)
    {
        $redirect =  parent::update($request, $id); 
    
        $attributes = json_decode($request->input('attributesList'));
        
        $component = \App\Models\Component::find($id);
        
        \AttributeHelper::instance()->update_attributes($component,$attributes);
        
        return $redirect;
    }
}