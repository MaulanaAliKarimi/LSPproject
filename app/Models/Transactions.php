<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([ 'user_id', 'date', 'total', 'paytotal'])]
class Transaction extends Model
{
    Use Fillable;
}
