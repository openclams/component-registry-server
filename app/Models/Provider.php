<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    
    public function components()
    {
        return $this->hasMany(Component::class);
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    /**
     * Display all its components.
     *
     * @return string
     */
    public  function display()
    {
        $components = Component::where('provider_id','=',$this->id)
                    ->where('parent_id','=',NULL)
                    ->orderBy('order', 'asc')
                    ->get();
        
        
        return new \Illuminate\Support\HtmlString(
            \Illuminate\Support\Facades\View::make('providers.list', ['components' => $components ])->render()
        );
    }
}
