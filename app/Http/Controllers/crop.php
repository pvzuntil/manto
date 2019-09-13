<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class crop extends Controller
{
    //
    public function imgProfil(Request $a)
    {
        dd($a->img);
    }
}
