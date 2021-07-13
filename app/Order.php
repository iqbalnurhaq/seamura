<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\District;
use App\Models\Regency;
use App\Models\Village;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'products_id', 'amount', 'total_price', 'name', 'no_tlp', 'kota', 'kecamatan', 'desa', 'detail_alamat'
    ];

    protected $hidden = [

    ];

     public function details()
    {
        return $this->hasMany(Detail::class);
    }

      public function district(){
         return $this->belongsTo(District::class, 'kecamatan', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota', 'id');
    }

    public function village(){
         return $this->belongsTo(Village::class, 'desa', 'id');
    }

}
