<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $divisions = Division::paginate(10);;
    // return $divisions;
    return view('division.index')->with('divisions', $divisions);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('division.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    // $this->validateDivision($request);
    
    $messages = ["unique" => 'Nama divisi harus unik'];
    $request->validate([
      'name' => 'required|unique:divisions|min:2',
    ], $messages);
    
    $division = new Division();
    $division->name = $request->name;
    
    // return '$validatedData';
    $division->save();
    return redirect('/divisions');
  }



  /**
   * Display the specified resource.
   *
   * @param  \App\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
    $division = Division::find($id);
    // return 'haloooo'.$division;
    return view('division.edit')->with('division', $division);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $division = Division::find($id);
    return view('division.edit')->with('division', $division);
  }

  /**
   * Update the specified resdivisionource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
    $division = Division::find($id);
    $division->name = $request->name;
    $division->save();
    return redirect('/divisions');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Division  $division
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
    // return 'deleteeeee'.$id;

    $division_user = DB::table('users')
                      ->join('divisions', 'users.division_id', '=' , 'divisions.id')
                      ->select('users.*', 'divisions.name as division_name')
                      ->where('division_id', '=', $id)->first();

    if ($division_user) {
      // return $division_user->division_name;
      return redirect('/divisions')->withErrors(['Ada user dibawah divisi '.$division_user->division_name.', tidak bisa meghapus divisi']);
    }

    $division = Division::find($id);
    $division->delete();
    // error_log('masukkkkkkkkk');
    // error_log($division->name);

    return redirect('/divisions');
  }
}
