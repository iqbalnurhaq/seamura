<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $fillable = [
        'province_id', 'name', 'id_re'
    ];

    protected $hidden = [
         'province_id'
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
