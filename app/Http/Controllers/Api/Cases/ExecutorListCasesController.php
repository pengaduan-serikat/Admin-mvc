<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Cases;
use App\Feedback;

class ExecutorListCasesController extends Controller
{
  public function index() {
    $user = Auth::user();

    $cases = Cases::where('executor_id', $user->id)
              // ->join('feedbacks', function($join)  {
              //   $join->on('feedbacks.case_id', '=', 'cases.id')
              //       ->where('feedbacks.case_status_id', 1);
              //       ->orderBy('feedbacks.created_at', 'ASC')
              //       ->first*
              //       // ->limit(1);
              // })
              // ->join('case_status', 'feedbacks.case_status_id', '=', 'case_status.id')
              ->select(
                  'cases.*',

                )
              ->orderBy('cases.created_at', 'DESC')
              ->paginate(10);
    return $cases;
  }
}