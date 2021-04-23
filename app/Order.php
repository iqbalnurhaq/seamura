<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
