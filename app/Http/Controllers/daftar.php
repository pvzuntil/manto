<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//
use Hash;
use App\tuser;
use App\tset;
use App\tkar;


class daftar extends Controller
{
    //
    public function index()
    {
      if (session()->get('idUser')) {
        // code...
        return redirect()->route('home');
      }else {
        // code...
        return view('daftar');
      }
    }

    public function daftar(request $a)
    {
      // code...
      $a->validate([
        'nama'=>'required',
        'email'=>'required|email',
        'password'=>'required|same:passwordKon|min:8'
      ]);

      $cekEmail = tuser::where([
        'email'=>$a->email
      ])->count();

      $cekEmailKar = tkar::where([
        'email'=>$a->email
      ])->count();

      if ($cekEmail > 0 || $cekEmailKar > 0) {
        // code...
        session()->flash('emailSudahAda');
        return redirect()->route('daftar');
      }else {
        tuser::create([
          'nama'=>$a->nama,
          'email'=>$a->email,
          'namaToko'=>'Toko '.substr($a->nama,0,5),
          'password'=>Hash::make($a->password),
          'level'=>'admin',
        ]);

        $ambilUser = tuser::where([
          'email'=>$a->email
        ])->get();

        tset::create([
          'idUser'=>$ambilUser[0]->id,
          'imgProfil'=>'/ico/large/profil.png',
          'imgSampul'=>'/imgSampul/default.png',
          'syaratKetentuan'=>'0',
          'tema'=>'1',
        ]);

        session()->flash('berhasilDaftar');
        return redirect()->route('masuk');
      }

    }
}
