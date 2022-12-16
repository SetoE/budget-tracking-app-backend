<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $user = $request->user();

    return TransactionResource::collection(Transaction::where('user_id', $user->id)->paginate());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreTransactionRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreTransactionRequest $request)
  {
    $result = Transaction::create($request->validated());

    return new TransactionResource($result);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function show(Transaction $transaction, Request $request)
  {
    $user = $request->user();

    if ($user->id !== $transaction->user_id) {
      return \abort('403', 'Unauthorized action.');
    }

    return new TransactionResource($transaction);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateTransactionRequest  $request
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateTransactionRequest $request, Transaction $transaction)
  {
    $transaction->update($request->validated());

    return new TransactionResource($transaction);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Transaction  $transaction
   * @return \Illuminate\Http\Response
   */
  public function destroy(Transaction $transaction, Request $request)
  {
    $user = $request->user();

    if ($user->id !== $transaction->user_id) {
      return \abort('403', 'Unauthorized action.');
    }

    $transaction->delete();

    return \response('', 204);
  }
}
