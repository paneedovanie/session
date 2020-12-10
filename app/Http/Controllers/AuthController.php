<?php

namespace App\Http\Controllers;

use App\Http\Resources\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $controller = new UserController;
    $result = $controller->store($request);

    if(isset($result->errors)) return $result;

    return new JsonResource(['user' => $result, 'token' => $result->createToken('authToken')->accessToken]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    $this->validator($request);

    if(!$this->guard()->attempt(request(['email', 'password']))) return response(['errors' => ['email' => 'Invalid credentials']], 422);

    $user = $this->guard()->user();

    return new JsonResource(['user' => $user, 'token' => $user->createToken('authToken')->accessToken]);
  }

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
      return Auth::guard();
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  Request  $request
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(Request $request, $id = null)
  {
      $validation = [
          'email' => ['required', 'string', 'email'],
          'password' => ['required', 'string']
      ];

      return $request->validate($validation);
  }
}