<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    public $timestamps = false;
    protected $fillable = ['transaction_id', 'item_id', 'qty', 'subtotal'];

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'transaction_id');
    }
}