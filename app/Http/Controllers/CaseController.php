<?php

namespace App\Http\Controllers;

use App\Cases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
  public function index() {
    $cases = Cases::join('case_status', 'cases.case_status_id', '=', 'case_status.id')
                    ->join('users', 'cases.user_id', '=', 'users.id')
                    ->select(
                      'cases.*',
                      'case_status.name as case_status',
                      DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"))
                    ->get();
    // $case_status = DB::table('case_status')->get();

    // $data = [
    //   'cases' => $cases,
    //   'case_status' => $case_status
    // ];
    // return $cases;
    return view('cases.index')->with('cases', $cases);
  }
}