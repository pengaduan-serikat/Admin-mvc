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
    $feedback->case_id = $id;
    $feedback->save();

    // $case->feedback_id = $feedback->id;
    // $case->case_status_id = $completeStatus->id;
    // $case->save();
    $case = Cases::where('cases.id', '=', $id)
      ->join('users as user', 'user.id', '=', 'cases.user_id')
      ->join('users as executor', 'executor.id', '=', 'cases.executor_id')
      ->join('case_status', 'case_status.id', '=', 'cases.case_status_id')
      ->leftJoin('feedbacks', 'feedbacks.case_id', '=', 'cases.id')
      ->select('cases.*', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as user_full_name"), DB::raw("CONCAT(executor.first_name, ' ', executor.last_name) as executor_full_name"), 'case_status.name as case_status', 'feedbacks.description as feedback')
      ->first();

    return $case;
  }
}