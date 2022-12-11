<?php

use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transaction_transfers', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class, 'user_id');
      $table->foreignIdFor(Transaction::class, 'transaction_id');
      $table->decimal('amount');
      $table->foreignIdFor(Transfer::class, 'transfer_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('transaction_transfers');
  }
};
