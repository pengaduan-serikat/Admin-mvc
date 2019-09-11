<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetDownloadLinkController extends Controller
{
  public function index(){
    $link = 'http://google.com';

    return response()->json(['url' => $link]);
  }
}