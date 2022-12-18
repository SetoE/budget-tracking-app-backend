<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  protected function prepareForValidation()
  {
    $this->merge([
      'user_id' => $this->user()->id,
    ]);
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|string|max:100',
      'description' => 'required|string|max:1000',
      'user_id' => 'exists:users,id',
      'payor_payee' => 'string|max:100',
      'amount' => 'required|numeric',
      'date' => 'required|date',
      'time' => 'required|date_format:H:i',
    ];
  }
}
