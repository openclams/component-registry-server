<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Component;
use Illuminate\Support\Facades\DB;


class TemplateController extends \TCG\Voyager\Http\Controllers\Controller
{
    public function builder(Component $component)
    {    
        $this->authorize('edit', $component);

        return view('templates.builder', compact('component'));
    }

    public function delete_item(Request $request, Component $component)
    {
        $this->authorize('delete', $component);

        $data =  $request->all();
        
        $pivot_id = $data['pivot'];
        
        DB::table('component_template')->where('id', '=', $pivot_id)->delete();
        
        return redirect()
            ->route('voyager.template.builder', [$component->id])
            ->with([
                'message'    => "Successfully deleted.",
                'alert-type' => 'success',
            ]);
    }

    public function add_item(Request $request, Component $component)
    {
        $this->authorize('add', $component);
        
        $data =  $request->all();
        
        $component_id = $data['component_id'];
        
        $component->components()->attach($component_id);
        
        return redirect()
            ->route('voyager.template.builder', [$component->id])
            ->with([
                'message'    => "Successfully added.",
                'alert-type' => 'success',
            ]);
    }

    public function order_item(Request $request, Component $component)
    {
        $componentOrder = json_decode($request->input('order'));

        foreach ($componentOrder as $index => $componentItem) {
            DB::table('component_template')
              ->where('id', $componentItem->pivot)
              ->update( ['order' => $index + 1 ]);
        }       
    }

    

}
