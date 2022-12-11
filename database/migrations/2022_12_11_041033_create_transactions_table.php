<?php

use App\Models\TransactionCategory;
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
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class, 'user_id');
      $table->decimal('amount');
      $table->string('description', 1000)->nullable();
      $table->tinyInteger('status');
      $table->string('payee_payor')->nullable();
      $table->foreignIdFor(TransactionCategory::class, 'category_id')->nullable();
      $table->date('date');
      $table->time('time');
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
    Schema::dropIfExists('transactions');
  }
};
