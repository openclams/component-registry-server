<?php
namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;

class EdgeController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function update(Request $request, $id)
    {
        $redirect =  parent::update($request, $id); 
    
        $attributes = json_decode($request->input('attributesList'));
        
        $edge = \App\Models\Edge::find($id);
        
        \AttributeHelper::instance()->update_attributes($edge, $attributes);
        
        $constrains = json_decode($request->input('constrainsList'));
        
        $this->update_edge_constrains($edge,$constrains);
        
        return $redirect;
    }
    
    public function update_edge_constrains($edge,$constrains){

        $remaining_constrains_ids = [];
       
        foreach($constrains as $constrain){
            $c = NULL;
            // edge_id	from_component_id	to_component_id
            if($constrain->id){
                $c = \App\Models\EdgeConstraint::find($constrain->id);
                
                $c->type = $constrain->type;
                $c->from_component_id = $constrain->from;
                $c->to_component_id = $constrain->to;
                $c->edge_id = $edge->id;
                
                $c->save();
            }else{
                $c = \App\Models\EdgeConstraint::create([
                    'type' => $constrain->type,
                    'from_component_id' => $constrain->from,
                    'to_component_id' => $constrain->to,
                    'edge_id' => $edge->id
                ]);
                $c->save();
            }
            
            $remaining_constrains_ids[] = intval($c->id);
        }
        
        $all_constrains_ids = $edge->constraints()
                ->get()
                ->map(function($a){return $a->id;})
                ->toArray();
        
        $diff_ids = array_diff($all_constrains_ids, $remaining_constrains_ids);
  
       
        foreach($diff_ids as $id){
          
            $a = \App\Models\EdgeConstraint::find($id);

            $a->delete();       
        }
    }
}