<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
  public function register(Request $request)
  {

    $data = $request->validate([
      'name' => ['string', 'required'],
      'email' => [
        'required',
        'email',
        'string',
        'unique:users,email',
      ],
      'password' => [
        'required',
        'confirmed',
        Password::min(8)->mixedCase()->numbers()->symbols()
      ],
    ]);

    /** @var User $user */
    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => \bcrypt($data['password']),
    ]);

    $token = $user->createToken('main')->plainTextToken;

    return \response([
      'user' => $user,
      'token' => $token,
    ]);
  }
}