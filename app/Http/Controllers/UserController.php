<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $filter = $request->query('filter');

    $admin_access_type = DB::table('access_types')->where('name', '=', 'admin')->first();
    $access_types = DB::table('access_types')->where('name', '!=', 'admin')->get();
    if ($filter === null || $filter === '0') {
      $users = DB::table('users')
                ->join('access_types', 'users.access_type_id', '=', 'access_types.id')
                ->join('divisions', 'users.division_id', '=', 'divisions.id')
                ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                ->where('users.access_type_id', '!=', $admin_access_type->id)
                ->select('users.*', 'access_types.name as access_type', 'divisions.name as division', 'positions.name as position')
                ->get();
    } else {
      // return 'sini';
      $users = DB::table('users')
                ->join('access_types', 'users.access_type_id', '=', 'access_types.id')
                ->join('divisions', 'users.division_id', '=', 'divisions.id')
                ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                ->where('users.access_type_id', '=', $filter)
                ->where('users.access_type_id', '!=', $admin_access_type->id)
                ->select('users.*', 'access_types.name as access_type', 'divisions.name as division', 'positions.name as position')
                ->get();
    }
      $data = [
        'users' => $users,
        'access_types' => $access_types,
        'filter' => $filter,
      ];
    return view('user.index')->with('data', $data);
    // return $data;
  }

  public function indexEmployees() {
    $acces_types = DB::table('access_types')->where('name', 'User')->first();
    $users = DB::table('users')
              ->join('access_types', 'users.access_type_id', '=', 'access_types.id')
              ->join('divisions', 'users.division_id', '=', 'divisions.id')
              ->join('positions', 'users.position_id', '=', 'positions.id')
              ->select('users.*', 'access_types.name as access_type', 'divisions.name as division', 'positions.name as position')
              ->where('users.access_type_id', $acces_types->id)
              ->get();
    // return $users;
    return view('employees.index')->with('users', $users);
  }

  public function indexExecutors() {
    $acces_types = DB::table('access_types')->where('name', 'Executor')->first();
    $users = DB::table('users')
              ->join('access_types', 'users.access_type_id', '=', 'access_types.id')
              ->join('divisions', 'users.division_id', '=', 'divisions.id')
              ->select('users.*', 'access_types.name as access_type', 'divisions.name as division')
              ->where('users.access_type_id', $acces_types->id)
              ->get();
    // return $users;
    return view('executors.index')->with('users', $users);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $access_types = DB::table('access_types')->where('name', '!=', 'admin')->get();
    $executor_type = DB::table('access_types')->where('name', '=', 'executor')->first();
    $divisions = DB::table('divisions')->get();
    $positions = DB::table('positions')->get();
    
    $data = [
      'access_types' => $access_types,
      'positions' => $positions,
      'divisions' => $divisions,
      'executor_type' => $executor_type,
    ];
    // return $data['positions'];
    return view('user.create')->with('data', $data);
  }

  public function createEmployee() {
    $access_types = DB::table('access_types')->where('name', 'User')->get();
    $divisions = DB::table('divisions')->get();
    $positions = DB::table('positions')->get();

    $data = [
      'access_types' => $access_types,
      'positions' => $positions,
      'divisions' => $divisions,
    ];
    // return $data['positions'];
    // return $data;
    return view('employees.create')->with('data', $data);
  }

  public function createExecutor() {
    $access_types = DB::table('access_types')->where('name', 'Executor')->get();
    $divisions = DB::table('divisions')->get();
    $data = [
      'access_types' => $access_types,
      'divisions' => $divisions,
    ];
    // return $data['positions'];
    // return $data;
    return view('executors.create')->with('data', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user = new User();
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->access_type_id = $request->access_types;
    $user->division_id = $request->divisions;
    $user->position_id = $request->positions;
    // $user->username = $request->username;
    $user->active = false;
    $user->email = $request->email;
    $user->password = bcrypt('12345');
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/users');
  }
  

  public function storeEmployee(Request $request) {
    $user = new User();
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->access_type_id = $request->access_types;
    $user->division_id = $request->divisions;
    $user->position_id = $request->positions;
    // $user->username = $request->username;
    $user->active = false;
    $user->email = $request->email;
    $user->password = bcrypt('12345');
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/employees');
  }

  public function storeExecutor(Request $request) {
    $user = new User();
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->access_type_id = $request->access_types;
    $user->division_id = $request->divisions;
    // $user->username = $request->username;
    $user->active = false;
    $user->email = $request->email;
    $user->password = bcrypt('12345');
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/executors');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    $acces_types = DB::table('access_types')->get();
    $positions = DB::table('positions')->get();
    $divisions = DB::table('divisions')->get();
    $data = [
      'user' => $user,
      'access_types' => $acces_types,
      'positions' => $positions,
      'divisions' => $divisions,
    ];

    return view('user.edit')->with('data', $data);
  }

  public function showEmployee($id) {
    $user = User::find($id);
    $acces_types = DB::table('access_types')->where('name', 'User')->get();
    $positions = DB::table('positions')->get();
    $divisions = DB::table('divisions')->get();
    $data = [
      'user' => $user,
      'access_types' => $acces_types,
      'positions' => $positions,
      'divisions' => $divisions,
    ];

    return view('employees.edit')->with('data', $data);
  }

  public function showExecutor($id) {
    $user = User::find($id);
    $acces_types = DB::table('access_types')->where('name', 'Executor')->get();
    $divisions = DB::table('divisions')->get();
    $data = [
      'user' => $user,
      'access_types' => $acces_types,
      'divisions' => $divisions,
    ];

    return view('executors.edit')->with('data', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    $acces_types = DB::table('access_types')->get();
    $positions = DB::table('positions')->get();
    $divisions = DB::table('divisions')->get();
    $data = [
      'user' => $user,
      'access_types' => $acces_types,
      'positions' => $positions,
      'divisions' => $divisions,
    ];

    return view('user.edit')->with('data', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->access_type_id = $request->access_types;
    $user->division_id = $request->divisions;
    $user->position_id = $request->positions;
    // $user->username = $request->username;
    $user->email = $request->email;
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/users');
  }

  public function updateEmployee(Request $request, $id)
  {
    $user = User::find($id);
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->access_type_id = $request->access_types;
    $user->division_id = $request->divisions;
    $user->position_id = $request->positions;
    // $user->username = $request->username;
    $user->email = $request->email;
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/employees');
  }

  public function updateExecutor(Request $request, $id)
  {
    $user = User::find($id);
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->access_type_id = $request->access_types;
    $user->division_id = $request->divisions;
    $user->position_id = $request->positions;
    // $user->username = $request->username;
    $user->email = $request->email;
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/executors');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();
    return redirect('/users');
  }

  public function destroyEmployee($id)
  {
    $user = User::find($id);
    $user->delete();
    return redirect('/employees');
  }
  
  public function destroyExecutor($id)
  {
    $user = User::find($id);
    $user->delete();
    return redirect('/executors');
  }
}
