<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
  public function changePassword(Request $request)
  {
    $user = Auth::user();
    $oldPassword = $request->oldPassword;
    $newPassword = $request->newPassword;
    $confirm = $request->confirm;
    
    if (!Hash::check($oldPassword, $user->password)) {
      return response()->json(['message' => 'Incorrect old password '], 400);
    }

    if ($newPassword !== $confirm) {
      return response()->json(['message' => 'New password and confirm password need to be same'], 400);
    }

    Auth::user()->password = bcrypt($newPassword);
    Auth::user()->save();
    return response()->json(['message' => 'Successfully changed password']);
  }
}
