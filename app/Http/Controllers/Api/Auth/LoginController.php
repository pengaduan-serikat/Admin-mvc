<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string|max:255',
			'password' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		$credentials = $request->only('username', 'password');
		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['message' => 'invalid_credentials'], 401);
			}
		} catch (JWTException $e) {
			return response()->json(['message' => 'could_not_create_token'], 500);
		}
		$user = Auth::user();
		// $currentUser = array_merge($user->toArray(), ['token' => $token]);
		// return response()->json(compact('currentUser'));
		return response()->json(array_merge($user->toArray(), ['token' => $token]));
	}

	public function loginEmployee(Request $request)
	{
		$access_type = DB::table('access_types')->where('name', 'User')->first();
		$validator = Validator::make($request->all(), [
			'NIK' => 'required|string|max:255',
			'password' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json($validator->errors());
		}
		$credentials = $request->only('NIK', 'password');

		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['message' => 'invalid_credentials'], 401);
			}
		} catch (JWTException $e) {
			return response()->json(['message' => 'could_not_create_token'], 500);
		}
		$user = Auth::user();
		$division = DB::table('divisions')->where('id', '=', $user->division_id)->first();

		// if ($user->access_type_id !== $access_type->id) {
		// 	return response()->json(['message' => 'User type is not employee'], 400);
		// }

		if (!$user->active) {
			return response()->json(['message' => 'User not active'], 400);
		}
		
		// $currentUser = array_merge($user->toArray(), ['token' => $token]);
		// return response()->json(compact('currentUser'));
		return response()->json(array_merge($user->toArray(), ['token' => $token], ['division_name' => $division->name]));
	}
}
