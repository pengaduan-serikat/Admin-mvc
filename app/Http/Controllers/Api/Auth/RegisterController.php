<?php 

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;

class RegisterController extends Controller
{
  public function registerEmployee(Request $request) {
    $validator = Validator::make($request->all(), [
			'NIK' => 'required|string|max:255',
			'email' => 'required|string|max:255'
		]);
		if ($validator->fails()) {
			return response()->json($validator->errors());
    }

    $access_type = DB::table('access_types')->where('name', 'User')->first();
    $user = User::where([
      ['NIK', $request->NIK],
      ['access_type_id', $access_type->id],
    ])->first();
    
    
    // $user = DB::table('users')->where([
    //   ['NIK', '=', $request->NIK],
    //   ['access_type_id', $access_type->id],
    // ])->first();

    if (!$user) {
      return response()->json(['message' => 'Incorrect NIK or email']);
    }
    
    if ($user->active) {
      return response()->json(['message' => 'User already active']);
    }

    $user->active = true;
    $user->save();
    
    return response()->json(['message' => 'Successfully register'], 201);
  }

  public function registerExecutor(Request $request) {
    $validator = Validator::make($request->all(), [
			'NIK' => 'required|string|max:255',
			'email' => 'required|string|max:255'
		]);
		if ($validator->fails()) {
			return response()->json($validator->errors());
    }

    $access_type = DB::table('access_types')->where('name', 'Executor')->first();
    $user = User::where([
      ['NIK', $request->NIK],
      ['access_type_id', $access_type->id],
    ])->first();
    
    
    // $user = DB::table('users')->where([
    //   ['NIK', '=', $request->NIK],
    //   ['access_type_id', $access_type->id],
    // ])->first();

    if (!$user) {
      return response()->json(['message' => 'Incorrect NIK or email']);
    }
    
    if ($user->active) {
      return response()->json(['message' => 'User already active']);
    }

    $user->active = true;
    $user->save();
    
    return response()->json(['message' => 'Successfully register'], 201);
  }
}