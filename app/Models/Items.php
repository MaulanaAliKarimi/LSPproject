<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([ 'category_id', 'name', 'price', 'stock'])]
class Items extends Model
{
    Use Fillable;
}
