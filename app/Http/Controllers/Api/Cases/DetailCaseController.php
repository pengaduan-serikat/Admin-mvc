<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Cases;
use App\Feedback;
use Illuminate\Support\Facades\DB;

class DetailCaseController extends Controller
{
  public function index($id) {
    $case = Cases::where('cases.id', '=', $id)
            ->join('users as user', 'user.id', '=', 'cases.user_id')
            ->join('users as executor', 'executor.id', '=', 'cases.executor_id')
            // ->leftJoin('feedbacks', 'feedbacks.case_id', '=', 'cases.id')
            // ->join('case_status', 'case_status.id', '=', 'cases.case_status_id')
            ->select(
              'cases.*', 
              DB::raw("CONCAT(user.first_name, ' ', user.last_name) as user_full_name"), 
              DB::raw("CONCAT(executor.first_name, ' ', executor.last_name) as executor_full_name")
              // 'case_status.name as case_status', 
              // 'feedbacks.description as feedback'
              )
            ->first();
    $feedbacks = Feedback::join('case_status', 'feedbacks.case_status_id', '=', 'case_status.id')
            ->select(
              'feedbacks.*',
              'case_status.name as case_status'
              )
            ->where('feedbacks.case_id', '=', $id)
            ->get();
    $data = [
      'case' => $case,
      'feedbacks' => $feedbacks,
    ];
    return $data;
  }

  public function indexByUsers($id) {
    $case = Cases::where('cases.id', '=', $id)
            ->join('users as user', 'user.id', '=', 'cases.user_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'cases.executor_id')
            // ->join('case_status', 'case_status.id', '=', 'cases.case_status_id')
            // ->leftJoin('feedbacks', 'feedbacks.case_id', '=', 'cases.id')
            ->select(
              'cases.*', 
              DB::raw("CONCAT(user.first_name, ' ', user.last_name) as user_full_name"), 
              DB::raw("CONCAT(executor.first_name, ' ', executor.last_name) as executor_full_name")
              // 'case_status.name as case_status', 'feedbacks.description as feedback'
              )
            ->first();
    $feedbacks = Feedback::join('case_status', 'feedbacks.case_status_id', '=', 'case_status.id')
            ->select(
              'feedbacks.*',
              'case_status.name as case_status'
              )
            ->where('feedbacks.case_id', '=', $id)
            ->get();
    $data = [
      'case' => $case,
      'feedbacks' => $feedbacks,
    ];
    return $data;
  }
}