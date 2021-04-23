<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Regency;

class Ongkir extends Model
{
     protected $fillable = [
        'district_id', 'ongkir'
    ];

    protected $hidden = [
        
    ];

    public function district(){
         return $this->belongsTo(District::class, 'district_id', 'id');
    }

    
}
