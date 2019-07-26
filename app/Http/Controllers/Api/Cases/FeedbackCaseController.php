<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Feedback;
use App\Cases;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeedbackCaseController extends Controller
{
  public function index(Request $request, $id) {
    $inProgStatus = DB::table('case_status')->where('name', 'In Progress')->first();
    $completeStatus = DB::table('case_status')->where('name', 'Completed')->first();

    $case = Cases::find($id);

    if ($case->case_status_id != $inProgStatus->id) {
      return response()->json(['message' => 'Hanya pengaduan berstatus In Progress yang dapat diberikan feedback'], 400);
    }

    $feedback = new Feedback();
    $feedback->description = $request->description;
    $feedback->save();

    $case->feedback_id = $feedback->id;
    $case->case_status_id = $completeStatus->id;
    $case->save();

    return $case;
  }
}