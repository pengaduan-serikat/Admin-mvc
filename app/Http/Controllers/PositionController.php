<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $positions = Position::paginate(10);;
    // return $divisions;
    return view('position.index')->with('positions', $positions);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('position.create');    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $position = new Position();
    $position->name = $request->name;

    $position->save();
    return redirect('/positions');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Position  $position
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
    $position = Position::find($id);
    // return 'haloooo'.$division;
    return view('position.edit')->with('position', $position);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Position  $position
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $position = Position::find($id);
    // return 'haloooo'.$division;
    return view('position.edit')->with('position', $position);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Position  $position
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
    $position = Position::find($id);
    $position->name = $request->name;
    $position->save();
    return redirect('/positions');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Position  $position
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $position_user = DB::table('users')
    ->join('positions', 'users.position_id', '=' , 'positions.id')
    ->select('users.*', 'positions.name as position_name')
    ->where('position_id', '=', $id)->first();

    if ($position_user) {
      // return $position_user->position_name;
      return redirect('/positions')->withErrors(['Ada user dibawah posisi '.$position_user->position_name.', tidak bisa meghapus divisi']);
    }

    $position = Position::find($id);
    $position->delete();
    // error_log('masukkkkkkkkk');
    // error_log($division->name);

    return redirect('/positions');
  }
}
