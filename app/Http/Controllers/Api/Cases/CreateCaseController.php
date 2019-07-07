<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cases;
use Validator;
use Illuminate\Support\Facades\DB;

class CreateCaseController extends Controller
{
  public function index(Request $request) {
    $validator = Validator::make($request->all(), [
			'title' => 'required|string|max:30',
			'description' => 'required'
		]);
    
    if ($validator->fails()) {
			return response()->json($validator->errors());
    }

    $user = Auth::user();
    $case_status = DB::table('case_status')->where('name', 'Submitted')->first();
    $case = new Cases();
    $case->user_id = $user->id;
    $case->title = $request->title;
    $case->description = $request->description;
    $case->case_status_id = $case_status->id;
    $case->save();

    return response()->json(['message' => 'Successfully create new case'], 200);
  }
}