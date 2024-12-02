<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'category_id',
        'image',
        'name',
        'description',
    ];
}
