<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
  public function index(){
    $events = DB::table('events')
              ->join('users', 'events.user_id', 'users.id')
              ->select('events.*', 'users.first_name as created_by')
              ->paginate(10);

    return $events;
  }
}