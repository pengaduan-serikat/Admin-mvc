<?php

namespace App\Http\Controllers;

use App\Cases;
use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
  public function index(Request $request) {
    $month = DB::select( DB::raw("SELECT DISTINCT MONTH(created_at) value, MONTHNAME(created_at) name from cases") );
    $year = DB::select( DB::raw("SELECT DISTINCT YEAR(created_at) value, YEAR(created_at) name from cases") );
    $caseStatus = DB::select( DB::raw("select cases.case_status_id as value, case_status.name as name from cases
inner join case_status on cases.case_status_id = case_status.id") );
    
    $monthFilter = $request->query('month');
    $yearFilter = $request->query('year');
    $caseStatusFilter = $request->query('case_status');

 
    $queryCase = Cases::query();

    $queryCase->join('users', 'cases.user_id', '=', 'users.id')
              // ->join('feedbacks', function($join)  {
              //   $join->on('feedbacks.case_id', '=', 'cases.id')
              //       ->orderBy('feedbacks.created_at', 'DESC')
              //       ->limit(1);
              // })
              ->join('case_status', 'cases.case_status_id', '=', 'case_status.id')
              ->select(
                'cases.*',
                'case_status.name as case_status',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"))
              ->orderBy('cases.created_at', 'desc');


    if ($monthFilter) {
      $queryCase->whereMonth('cases.created_at', '=', $monthFilter);
    }

    if ($yearFilter) {
      $queryCase->whereYear ('cases.created_at', '=', $yearFilter);
    }

    $data = [
      'cases' => $queryCase->paginate(10),
      'month' => $month,
      'year' => $year,
      'case_status' => $caseStatus,
    ];

    // return $queryCase->paginate(10);
    return view('cases.index')->with('data', $data);
    // return $data;
  }

  public function indexSumary(Request $request) {

  }

  public function show($id) {
    $cases = Cases::join('users', 'cases.user_id', '=', 'users.id')
                    ->join('case_status', 'cases.case_status_id', '=', 'case_status.id')
                    ->join('positions', 'users.position_id', '=', 'positions.id')
                    ->select(
                      'cases.*',
                      'case_status.name as case_status',
                      DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"),
                      'positions.name as position_name'
                      )
                    ->where('cases.id', '=', $id)
                    ->first();
    $executorType = DB::table('access_types')->where('name', 'executor')->first();
    $executors = DB::table('users')
                      ->where('access_type_id', $executorType->id)
                      ->where('active', true)
                      ->get();
    $submittedStatus = DB::table('case_status')->where('name', 'Submitted')->first();
    $feedback = Feedback::join('case_status', 'feedbacks.case_status_id', '=', 'case_status.id')
                        ->select(
                          'feedbacks.*',
                          'case_status.name as case_status'
                          )
                        ->where('feedbacks.case_id', '=', $id)
                        ->get();
    $data = [
      'case' => $cases,
      'executors' => $executors,
      'submittedStatus' => $submittedStatus,
      'feedbacks' => $feedback,
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

    $case_status = DB::table('case_status')->where('name', 'In Progress')->first();

    $feedback = new Feedback();
    $feedback->case_id = $id;
    $feedback->case_status_id = $case_status->id;
    $feedback->description = 'Case in progress';
    $feedback->save();

    // return $feedback;
    return redirect('/cases');;
  }
}