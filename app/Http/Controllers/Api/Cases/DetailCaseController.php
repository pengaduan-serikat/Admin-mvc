<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Cases;
use Illuminate\Support\Facades\DB;

class DetailCaseController extends Controller
{
  public function index($id) {
    $case = Cases::where('cases.id', '=', $id)
            ->join('users as user', 'user.id', '=', 'cases.user_id')
            ->join('users as executor', 'executor.id', '=', 'cases.executor_id')
            ->join('case_status', 'case_status.id', '=', 'cases.case_status_id')
            ->leftJoin('feedbacks', 'feedbacks.id', '=', 'cases.feedback_id')
            ->select('cases.*', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as user_full_name"), DB::raw("CONCAT(executor.first_name, ' ', executor.last_name) as executor_full_name"), 'case_status.name as case_status', 'feedbacks.description as feedback')
            ->first();
    return $case;
  }

  public function indexByUsers($id) {
    $case = Cases::where('cases.id', '=', $id)
            ->join('users as user', 'user.id', '=', 'cases.user_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'cases.executor_id')
            ->join('case_status', 'case_status.id', '=', 'cases.case_status_id')
            ->leftJoin('feedbacks', 'feedbacks.id', '=', 'cases.feedback_id')
            ->select('cases.*', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as user_full_name"), DB::raw("CONCAT(executor.first_name, ' ', executor.last_name) as executor_full_name"), 'case_status.name as case_status', 'feedbacks.description as feedback')
            ->first();
    return $case;
  }
}