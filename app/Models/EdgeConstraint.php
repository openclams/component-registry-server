<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdgeConstraint extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    
    public function edge()
    {
        return $this->belongsTo(Edge::class);
    }
    
    public function from()
    {
        return $this->belongsTo(Component::class, 'from_component_id');
    }
    
    public function to()
    {
        return $this->belongsTo(Component::class, 'to_component_id');
    }
    
    public function toArray()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            "from" => $this->from->id,
            "to" => $this->to->id,
            "fromName" => $this->from->name,
            "toName" => $this->to->name
        ];
    }
}
