<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    
   // protected $primaryKey = 'id_name';
    
    public $timestamps = false;
    
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    

    public function attributable()
    {
        return $this->morphTo();
    }
    
    public function toArray()
    {
        return [
            "id" => 'availability',
            "name" => "_Availability",
            "type" => 'number',
            "value" => $this->availability 
        ];
    }
}
