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

  public function show($id) {
    $cases = Cases::join('case_status', 'cases.case_status_id', '=', 'case_status.id')
                    ->join('users', 'cases.user_id', '=', 'users.id')
                    ->select(
                      'cases.*',
                      'case_status.name as case_status',
                      DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"))
                    ->where('cases.id', '=', $id)
                    ->first();
    $executorType = DB::table('access_types')->where('name', 'executor')->first();
    $executors = DB::table('users')
                      ->where('access_type_id', $executorType->id)
                      ->where('active', true)
                      ->get();
    $data = [
      'case' => $cases,
      'executors' => $executors,
    ];
    // return $data;
    return view('cases.edit')->with('data', $data);
  }

  public function update(Request $request, $id) {
    $case = Cases::where('id', $id)->first();
    $case_status = DB::table('case_status')->where('name', 'In Progress')->first();

    $case->executor_id = $request->executor;
    $case->case_status_id = $case_status->id;
    $case->save();
    return redirect('/cases');;
  }
}