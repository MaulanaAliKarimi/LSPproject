<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transactions::with('user')
                                    ->latest('date')
                                    ->get();
        return view('transaction', compact('transactions'));
    }
}