<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'categories_id', 'price', 'photo', 'diskon', 'size', 'stok'
    ];

    protected $hidden = [

    ];

    public function category(){
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
