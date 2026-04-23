<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'date', 'total', 'pay_total'];

    public function details()
    {
        return $this->hasMany(TransactionDetails::class, 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}