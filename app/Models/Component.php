<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;

class Component extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
    
    public function regions()
    {
        return $this->belongsToMany(Region::class);
    }
    
    public function childernCount()
    {
        return DB::table('components')->where('parent_id','=',$this->id)->count();
    }
    
    public function children()
    {
        return $this->hasMany(Component::class, 'parent_id');
    }
    
    public function countChildren()
    {
        return $this->loadCount('children');
    }
    
    public function costs()
    {
        return $this->hasMany(Cost::class);
    }
    
    public function parent()
    {
        return $this->belongsTo(Component::class, 'parent_id');
    }
    
    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_template', 'template_id', 'component_id');
    }
    public function toArray()
    {
        $result = [
                "id" => $this->id,
                "name"=> $this->name,
                "img"=> ($this->img)? asset(Voyager::image($this->img)) : null, 
                "components" => $this->components->toArray(),
                "attributes" => $this->attributes()->get()->toArray(), 
        ];
        
        if($this->isTamplate){
            $result["components"] = $this->components->toArray();
        }
        
        return $result;
    }
}
