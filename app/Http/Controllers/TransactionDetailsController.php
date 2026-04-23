<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionDetailsController extends Controller
{
    public function show($id)
{
    $transaction = Transactions::with('details.item')->findOrFail($id);

    return view('transaction_detail', compact('transaction'));
}
}