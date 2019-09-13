<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class keluar extends Controller
{
    //
    public function keluar()
    {
      session::flush('idUser, idKar, level, email');
      session()->flash('berhasilKeluar');
      return redirect()->route('masuk');
    }
}
