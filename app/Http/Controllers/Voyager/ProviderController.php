<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Component;
use Illuminate\Support\Facades\DB;

class ProviderController extends \TCG\Voyager\Http\Controllers\Controller
{
    public function builder(Provider $provider)
    {    
        $this->authorize('edit', $provider);

        return view('providers.builder', compact('provider'));
    }

    public function delete_item(Provider $provider, Component $component)
    {
        $this->authorize('delete', $component);

        $component->attributes()->delete();
        
        $component->delete();
        
        return redirect()
            ->route('voyager.providers.builder', [$provider->id])
            ->with([
                'message'    => "Successfully deleted.",
                'alert-type' => 'success',
            ]);
    }

    public function add_item(Request $request, Provider $provider)
    {
        $this->authorize('add', $provider);

        $data =  $request->all();

        unset($data['id']);
        
        //$data['order'] = DB::table('components')->max('order') + 1 ;

        $c = Component::make();
        $c->name = $data['name'];
        $c->img  = $data['img'];
        $c->isTemplate = $data['isTemplate'];
        $c->provider_id = $provider->id;
        $c->order = 0;
        $c->save();
        
        $attributes = json_decode($data['attributes']);
        \AttributeHelper::instance()->update_attributes($c,$attributes);
        
        return redirect()
            ->route('voyager.providers.builder', [$data['provider_id']])
            ->with([
                'message'    => "New Component Added: ",
                'alert-type' => 'success',
            ]);
    }

    public function update_item(Request $request, Provider $provider)
    {
        $id = $request->input('id');
        $data = $request->except(['id']);
      

        $c = Component::findOrFail($id);

        $this->authorize('edit', $provider);

        $c->name = $data['name'];
        $c->img  = $data['img'];
        $c->isTemplate = $data['isTemplate'];
        $c->save();
        
        $attributes = json_decode($data['attributes']);
        \AttributeHelper::instance()->update_attributes($c,$attributes);

        return redirect()
            ->route('voyager.providers.builder', [$provider->id])
            ->with([
                'message'    => "Update was successful.",
                'alert-type' => 'success',
            ]);
    }

    public function order_item(Request $request)
    {
        $componentOrder = json_decode($request->input('order'));
        $this->orderMenu($componentOrder, null);
    }

    private function orderMenu(array $componentItems, $parentId)
    {
        foreach ($componentItems as $index => $componentItem) {
            
            if(empty($componentItem->id)){continue;}
            
            $item = Component::find($componentItem->id);
            
            if(!$item){continue;}
            
            $item->order = $index + 1;
            
            $item->parent_id = $parentId;
            
            $item->save();

            if (isset($componentItem->children)) {
               
                $this->orderMenu($componentItem->children, $item->id);
                
            }
            
           
        }
    }
    
}
