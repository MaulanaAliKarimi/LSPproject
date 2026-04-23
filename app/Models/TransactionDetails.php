<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([ 'transaction_id', 'item_id', 'qty', 'subtotal'])]
class TransactionDetails extends Model
{
    Use Fillable;
}
