<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name'])]
class Categories extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
