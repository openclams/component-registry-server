<?php
namespace App\Helpers;


class AttributeHelper {
    function attrToArray($attributes){
        return $attributes->map(function($attr){
            return  [
                'id' => $attr->id,
                "id_name" => $attr->id_name,
                "name" => $attr->name,
                "type" => $attr->type,
                "value" => $attr->value 
            ];
        });
    }
    
    public function update_attributes($component,$attributes){

        $remaining_attributes_ids = [];
       
        foreach($attributes as $attribute){
            $a = NULL;
            
            if($attribute->id){
                $a = \App\Models\Attribute::find($attribute->id);
                
                $a->id_name = $attribute->id_name;
                $a->name = $attribute->name;
                $a->type = $attribute->type;
                $a->value = $attribute->value;
                $a->save();
            }else{
                $a = \App\Models\Attribute::create([
                    'id_name' => $attribute->id_name,
                    'name' => $attribute->name,
                    'type' => $attribute->type,
                    'value' => $attribute->value,
                    'readable' => 0
                ]);
                $a->save();
                $component->attributes()->attach($a);
            }
            
            $remaining_attributes_ids[] = intval($a->id);
        }
        
        $all_attributes_ids = $component->attributes()
                ->get()
                ->map(function($a){return $a->id;})
                ->toArray();
        
        $diff_ids = array_diff($all_attributes_ids, $remaining_attributes_ids);
       
        if( count($diff_ids) > 0){
            $component->attributes()->detach($diff_ids);
        }
       
        foreach($diff_ids as $id){
          
            $a = \App\Models\Attribute::find($id);

            $a->delete();       
        }
    }
    
    public static function instance()
    {
        return new AttributeHelper();
    }
}
