<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $divisions = Division::all();
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
    //
    // error_log($request->name);
    $division = new Division();
    $division->name = $request->name;

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
    $division = Division::find($id);
    $division->delete();
    // error_log('masukkkkkkkkk');
    // error_log($division->name);

    return redirect('/divisions');
  }
}
