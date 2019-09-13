<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use File;
use Hash;
use Session;

use App\tuser;
use App\tset;
use App\tkar;


class pengaturan extends Controller
{
    //
    public function index()
    {
      // code...

      if (session()->get('idUser') && session()->get('level') == 'admin') {
        // code...
        $isiUser = tuser::where([
          'id'=>session()->get('idUser')
        ])->get();

        $isiSet = tset::where([
          'id'=>session()->get('idUser')
        ])->get();

        return view('peng',[
          'user'=>$isiUser[0],
          'setting'=>$isiSet[0],
        ]);
      }else {
        return redirect()->route('masuk');
      }
    }
    public function uploadImgProfil(request $a)
    {
      $a->validate([
        'imgProfil'=>'max:2000'
      ]);

      $file = $a->file('imgProfil');

      $lokasiFile = '/imgProfil/';
      $namaFile = time().'.'.$file->getClientOriginalExtension();

      $file->move('imgProfil', $namaFile);

      tset::where([
        'idUser'=>session()->get('idUser')
      ])->update([
        'imgProfil'=>$lokasiFile.$namaFile
      ]);

      session()->flash('berhasilUpdateImgProfil');
      return redirect()->route('pengaturan');
    }

    public function uploadImgSampul(request $a)
    {
      $a->validate([
        'imgSampul'=>'max:2000'
      ]);

      $file = $a->file('imgSampul');

      $lokasiFile = '/imgSampul/';
      $namaFile = time().'.'.$file->getClientOriginalExtension();

      $file->move('imgSampul', $namaFile);

      tset::where([
        'idUser'=>session()->get('idUser')
      ])->update([
        'imgSampul'=>$lokasiFile.$namaFile
      ]);

      session()->flash('berhasilUpdateImgSampul');
      return redirect()->route('pengaturan');
    }

    public function updateNama(request $a)
    {
      tuser::where([
        'id'=>session()->get('idUser')
      ])->update([
        'nama'=>$a->nama
      ]);

      session()->flash('berhasilUpdateNama');
      return redirect()->route('pengaturan');
    }

    public function updateNamaToko(request $a)
    {
      tuser::where([
        'id'=>session()->get('idUser')
      ])->update([
        'namaToko'=>$a->namaToko
      ]);

      session()->flash('berhasilUpdateNamaToko');
      return redirect()->route('pengaturan');
    }

    public function updateEmail(request $a)
    {
      $cekEmail = tuser::where('email',$a->email)->count();
      $cekEmailKar = tkar::where('email',$a->email)->count();

      if($a->changerUpdateEmail == 1){
        if($cekEmail == 0 && $cekEmailKar == 0){

          $isiUser = tuser::where([
            'id'=>session()->get('idUser')
          ])->get();

          if (hash::check($a->password, $isiUser[0]->password)) {

            tuser::where([
              'id'=>session()->get('idUser')
            ])->update([
                'email'=>$a->email
            ]);

            Session::put([
              'email'=>$a->email
            ]);

            session()->flash('berhasilUpdateEmail');
            return redirect()->route('pengaturan');

          }else {
            session()->flash('passwordSalah');
            return redirect()->route('pengaturan');
          }
        }else{
          session()->flash('emailSudahAda');
          return redirect()->route('pengaturan');
        }
      }else{
        $isiUser = tuser::where([
          'id'=>session()->get('idUser')
        ])->get();

        if (hash::check($a->password, $isiUser[0]->password)) {

          tuser::where([
            'id'=>session()->get('idUser')
          ])->update([
              'email'=>$a->email
          ]);

          Session::put([
            'email'=>$a->email
          ]);

          session()->flash('berhasilUpdateEmail');
          return redirect()->route('pengaturan');

        }else{
          session()->flash('berhasilUpdateEmail');
          return redirect()->route('pengaturan');
        }
      }
      
    }
}
