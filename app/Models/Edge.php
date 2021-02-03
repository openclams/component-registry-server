<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
    
    public function constraints()
    {
        return $this->hasMany(EdgeConstraint::class);
    }
    
    public function toArray()
    {
        return [
          'name' => $this->name,
          //'allowed' => $this->constraints()->where('type', 'Allow')->get()->toArray(),
         //'exclude' => $this->constraints()->where('type', 'Exclude')->get()->toArray(),
          "attributes" => $this->attributes()->get()->toArray()
        ];
    }
}
