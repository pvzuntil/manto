<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Cookie;
//
use App\tuser;
use App\tkar;

class masuk extends Controller
{
    //

    public function index()
    {
      if (session()->get('idUser')) {
        // code...
        if (session()->get('level') == 'inv') {

          return redirect()->route('produk');
        }else{
          return redirect()->route('home');

        }
      }else {
        // code...
        // dd(session()->get('idUser'));
        return view('masuk');
      }
    }
    public function masuk(Request $a)
    {
      // code...
      $cekEmail = tuser::where([
        'email'=>$a->email
      ])->get();

      $cekEmailKar = tkar::where([
        'email'=>$a->email,
        'password'=>$a->password
      ])->get();

      if (count($cekEmail) == 1) {
        // code...
        if (Hash::check($a->password, $cekEmail[0]->password)) {
          // code...
          session::put([
            'idUser'=>$cekEmail[0]->id,
            'level'=>$cekEmail[0]->level,
            'email'=>$cekEmail[0]->email
          ]);

          // dd(session()->get('email'));

          // Cookie::queue('kat-column','name');
          // Cookie::queue('kat-sort','asc');

          session()->flash('berhasilMasuk');
          return redirect()->route('home');
        }else {
          session()->flash('gagalMasuk');
          return redirect()->route('masuk');
        }
      }else if(count($cekEmailKar) == 1){


        session::put([
          'idUser'=>$cekEmailKar[0]->idUser,
          'idKar'=>$cekEmailKar[0]->id,
          'level'=>$cekEmailKar[0]->level,
          'email'=>$cekEmailKar[0]->email
        ]);

        // dd(session()->get('email'));

        session()->flash('berhasilMasuk');

        if (session()->get('level') == 'inv'){

          return redirect()->route('produk');
        }else{

          return redirect()->route('home');
        }

      }else{
        session()->flash('gagalMasuk');
        return redirect()->route('masuk');
      }
    }
}
