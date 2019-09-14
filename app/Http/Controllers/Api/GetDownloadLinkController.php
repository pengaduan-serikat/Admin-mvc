<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetDownloadLinkController extends Controller
{
  public function index(){
    $link = 'https://drive.google.com/open?id=18_g0VG_yuCU43giXfVuVAtg7N5cL0SX1';

    return response()->json(['url' => $link]);
  }
}