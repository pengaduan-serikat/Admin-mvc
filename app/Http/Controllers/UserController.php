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
  public function index()
  {
    $users = DB::table('users')
              ->join('access_types', 'users.access_type_id', '=', 'access_types.id')
              ->join('divisions', 'users.division_id', '=', 'divisions.id')
              ->join('positions', 'users.position_id', '=', 'positions.id')
              ->select('users.*', 'access_types.name as access_type', 'divisions.name as division', 'positions.name as position')
              ->get();
    return view('user.index')->with('users', $users);
    // return $users;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $access_types = DB::table('access_types')->get();
    $divisions = DB::table('divisions')->get();
    $positions = DB::table('positions')->get();
    
    $data = [
      'access_types' => $access_types,
      'positions' => $positions,
      'divisions' => $divisions,
    ];
    // return $data['positions'];
    return view('user.create')->with('data', $data);
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
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = bcrypt('12345');
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/users');
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
    $user->username = $request->username;
    $user->email = $request->email;
    $user->NIK = $request->NIK;
    $user->save();
    return redirect('/users');
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
}