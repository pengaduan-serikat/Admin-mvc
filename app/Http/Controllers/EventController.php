<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
  public function index() {
    $events = DB::table('events')->paginate(10);
    return view('events.index')->with('events', $events);
  }

  public function create()
  {
    return view('events.create');
  }

  public function store(Request $request) {
    $messages = [
      "max" => 'Gambar tidak boleh melebihi 2 mb',
    ];
    request()->validate([
      'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], $messages);

    $imageName = time().'.'.request()->picture->getClientOriginalExtension();
    request()->picture->move(storage_path('public'), $imageName);

    $urlImage = URL::to('/').'/storage/'.$imageName;

    $event = new Event();
    $event->title = $request->title;
    $event->user_id = Auth::id();
    $event->picture = $urlImage;
    $event->description = $request->description;
    $event->save();
    return redirect('/events');
  }

  public function show($id) {
    $event = Event::find($id);
    return view('events.edit')->with('event', $event);
  }

  public function update(Request $request, $id)
  {

    $event = Event::find($id);
    $event->title = $request->title;
    $event->description = $request->description;
    
    if ($request->picture) {
      request()->validate([
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      
      $imageName = time().'.'.request()->picture->getClientOriginalExtension();
      request()->picture->move(storage_path('public'), $imageName);
      
      $urlImage = URL::to('/').'/storage/'.$imageName;
      $event->picture = $urlImage;
    }


    $event->save();
    return redirect('/events');
  }

  public function destroy($id)
  {
    $event = Event::find($id);
    $event->delete();

    return redirect('/events');
  }
}