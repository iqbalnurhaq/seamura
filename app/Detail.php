<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
     protected $fillable = [
        'products_id', 'order_id', 'qty'
    ];

    protected $hidden = [

    ];
}
