<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if($transaction == null)
        {
            return response()->json('the transaction doesn\'t exist', 404);
        }
        else
        {
            return response()->json($transaction);
        }
    }

    public function create(Request $request)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        if($transaction == null)
        {
            return response()->json('the transaction doesn\'t exist', 404);
        }
        else
        {
            $transaction->delete();
        }
    }
}
