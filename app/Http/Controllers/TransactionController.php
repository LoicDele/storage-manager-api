<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Transaction;

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
        $this->validate($request, Transaction::getRules());
        $transaction = new Transaction($request->all());
        $transaction->save();
        return response()->json($transaction, 200);
    }

    public function update($id, Request $request)
    {
        $transaction = Transaction::find($id);
        if($transaction == null)
        {
            return response()->json('the transaction doesn\'t exist', 404);
        }
        else
        {
            $this->validate($request, Transaction::getRules());
            $transaction->fill($request->all());
            $transaction->save();
            return response()->json($transaction, 200);
        }
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
