<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class ForgotPasswordController extends Controller
{
  public function index(Request $request) {
    $email = $request->email;
    $user = User::where('email', $email)->first();
    if (!$user) {
      return response()->json(['message' => 'Email tidak terdaftar'], 400);
    }
    
    $datetime = Carbon::now()->timestamp;
    $newPassword = substr(strval($datetime), 4);
    
    
    $newHashPassword = bcrypt($newPassword);
    $user->password = $newHashPassword;
    $user->save();
    
    $data = [
      'name' => $user->first_name,
      'newPassword' => $newPassword,
    ];

    Mail::send('email.forgot-password', $data, function($message) use($email) {
      $message->to($email)->subject('Perubahan password');
    });

    return response()->json(['message' => 'Email sent'], 200);
  }
}