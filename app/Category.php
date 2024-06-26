<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use softDeletes;
    protected $fillable = [
        'name', 'photo', 'slug'
    ];

    protected $hidden = [

    ];
}
