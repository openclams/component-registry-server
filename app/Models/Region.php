<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
    
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    
    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}
