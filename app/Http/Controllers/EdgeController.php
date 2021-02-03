<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Edge;
use Illuminate\Support\Facades\DB;

class EdgeController extends Controller
{
    public function index(Request $request, $fromComponent, $toComponent)
    { 
        $fc = Component::find($fromComponent);
        $tc = Component::find($toComponent);
        
        if(!$fc || !$tc){
            return [];
        }
        
        $from_array = $this->getParents($fc);   
        $to_array = $this->getParents($tc);     
        
        
        /**
         * Checkout all allowed edges also for patterns
         */
        $total_edges = DB::table('edge_constraints')
                ->select('edge_id')
                ->whereIn('from_component_id', $from_array)
                ->whereIn('to_component_id', $to_array)
                ->where('type','Allow')
                ->groupBy('edge_id')
                ->get()
                ->map(function($e){return $e->edge_id;})
                ->toArray();
     
        /**
         * Remove the 
         */
        $no_edges = DB::table('edge_constraints')
                    ->select('edge_id')
                    ->whereIn('edge_id', $total_edges)
                    ->where('from_component_id', $fromComponent)
                    ->where('to_component_id', $toComponent)
                    ->where('type','Exclude')
                    ->groupBy('edge_id')
                    ->get()
                    ->map(function($e){return $e->edge_id;})
                    ->toArray();
         
        
        $edges = array_diff($total_edges, $no_edges);         
        
        return Edge::find($edges)->toArray();
    }
    
    function getParents(Component $component){
        $result = [$component->id];
        while($component->parent){
            $parent = Component::find($component->parent_id);
            $result[] = $parent->id;
            $component = $parent;
        }
        return $result;
    }
    
    
}
