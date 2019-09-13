<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tuser;
use App\tset;
use App\tco;


class home extends Controller
{
    //

    public function index()
    {
      if (session()->get('idUser') && session()->get('level') == 'admin' || session()->get('level') == 'kasir') {
        // code...
        $isiUser = tuser::where([
          'id'=>session()->get('idUser')
        ])->get();

        $isiSet = tset::where([
          'idUser'=>session()->get('idUser')
        ])->get();

        $co = tco::where([
          'idUser'=>session()->get('idUser')
        ])->orderBy('created_at','asc')->get();


        if ($isiSet[0]->syaratKetentuan == 0) {
          // code...
          $baca = 1;
          return view('home',[
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'isiCo'=>$co,
            'baca'=>$baca
          ]);
        }else {
          $baca = 0;
          return view('home',[
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'isiCo'=>$co,
            'baca'=>$baca
          ]);
        }

      }else {
        return redirect()->route('masuk');
      }
    }

    public function confirm()
    {
      tset::where([
        'idUser'=>session()->get('idUser')
      ])->update([
        'syaratKetentuan'=>'1'
      ]);

      return redirect()->route('home');
    }
}
