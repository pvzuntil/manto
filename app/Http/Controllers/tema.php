<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\tset;

class tema extends Controller
{
    public function tema()
    {
        $cek = tset::find(session()->get('idUser'));

        if($cek->tema == '0'){
            $cek->update([
                'tema'=>'1'
            ]);
        }else if($cek->tema == '1'){
            $cek->update([
                'tema'=>'0'
            ]);
        }

        echo $cek->tema;

    }
}
