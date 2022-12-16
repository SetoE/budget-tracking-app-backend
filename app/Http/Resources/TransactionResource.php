<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'user_id' => $this->user_id,
      'amount' => $this->amount,
      'description' => $this->description,
      'payee_payor' => $this->payee_payor,
      'date' => $this->date,
      'time' => $this->time,
      'created_at' => $this->created_at,
      'transfers' => [],
    ];
  }
}