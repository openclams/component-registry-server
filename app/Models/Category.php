<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
    
    public function templates()
    {
        return $this->hasMany(Template::class);
    }
    
    public function toArray()
    {
        $components = $this->components->toArray();
        return [
          "name" =>$this->name,
          "components" => $components
        ];
    }
}
