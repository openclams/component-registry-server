<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function toArray()
    {
        return [
            'region' => [
                'id' => $this->region->id,
                'name' => $this->region->name
            ],
            'model' => $this->model,
            'cost' => $this->value
        ]; 
    }
}
