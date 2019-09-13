<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tpro;
use App\tpel;

use App\tuser;
use App\tkar;

use DB;

class tryCon extends Controller
{
    //
    public function index()
    {
      # code...
      // dd(session()->get('level'));
      return view('try');
    }
}
