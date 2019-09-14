<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetDownloadLinkController extends Controller
{
  public function index(){
    $link = 'https://drive.google.com/file/d/1PkM90E6dNglLWXZ3wv68MZIkk8I4G3L7/view?usp=sharing';

    return response()->json(['url' => $link]);
  }
}