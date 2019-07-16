<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;


class CheckTokenController extends Controller 
{
  public function index() {
    return response()->json(['message' => 'Token correct']);
  }
}