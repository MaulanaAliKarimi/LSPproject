<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public $timestamps = false;

    protected $fillable = ['category_id', 'name', 'price', 'stock'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}