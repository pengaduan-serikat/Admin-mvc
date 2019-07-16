<?php

namespace App\Http\Controllers\Api\Cases;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Cases;

class EmployeeListCasesController extends Controller
{
  public function index() {
    $user = Auth::user();

    $cases = Cases::where('user_id', $user->id)
              ->join('case_status', 'cases.case_status_id', '=', 'case_status.id')
              ->select('cases.*', 'case_status.name as case_status')
              ->get();

    return $cases;
  }
}