<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tkat;
use App\tuser;
use App\tset;

use App\tco;

class kate extends Controller
{
    //
    public function index()
    {
      if (session()->get('idUser') && session()->get('level') == 'admin' || session()->get('level') == 'inv') {
        $co = tco::where([
            'idUser'=>session()->get('idUser')
        ])->get();
  
        if (count($co)>0){
          
          $ambilKat = tkat::where([
            'idUser'=>session()->get('idUser')
          ])->orderby('created_at', 'asc')->get();
  
          $isiUser = tuser::where([
            'id'=>session()->get('idUser')
          ])->get();
  
          $isiSet = tset::where([
            'idUser'=>session()->get('idUser')
          ])->get();

          $statusCo = 1;
  
          return view('kate',[
            'isiKat'=>$ambilKat,
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'statusCo'=>$statusCo
          ]);
        }else{
          $ambilKat = tkat::where([
            'idUser'=>session()->get('idUser')
          ])->orderby('created_at', 'asc')->get();
  
          $isiUser = tuser::where([
            'id'=>session()->get('idUser')
          ])->get();
  
          $isiSet = tset::where([
            'idUser'=>session()->get('idUser')
          ])->get();

          $statusCo = 0;
  
          return view('kate',[
            'isiKat'=>$ambilKat,
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'statusCo'=>$statusCo
          ]);
        }
        // code...
      }else {
        return redirect()->route('masuk');
      }
    }
    public function tambah(request $a)
    {
      // code...
      $cekKodeKat = tkat::where([
        'idUser'=>session()->get('idUser'),
        'kodeKat'=>strtoupper($a->kodeKat)
      ])->get();

      // dd(count($cekKodeKat));

      if (count($cekKodeKat) > 0) {
        // code...
        session()->flash('gagalTambahKat');
        return redirect()->route('kate');
      }else {
        // code...
        tkat::create([
          'nama'=>$a->nama,
          'kodeKat'=>strtoupper($a->kodeKat),
          'desKat'=>$a->desKat,
          'idUser'=>session()->get('idUser')
        ]);

        $notif = tkat::where([
          'idUser'=>session()->get('idUser'),
          'kodeKat'=>strtoupper($a->kodeKat)
          ])->get();

          session()->flash('berhasilTambahKat');
          session()->flash('idKat',$notif[0]->id);

          return redirect()->route('kate');
      }

    }

    public function tambahInPro(request $a)
    {
      // code...
      // dd($a->nama);
      $cekKodeKat = tkat::where([
        'idUser'=>session()->get('idUser'),
        'kodeKat'=>strtoupper($a->kodeKat)
      ])->get();

      // dd(count($cekKodeKat));

      if (count($cekKodeKat) > 0) {
        // code...
        // session()->flash('gagalTambahKat');
        // return redirect()->route('produk');
        echo "tambahKatGagal";
      }else {
        // code...
        tkat::create([
          'nama'=>$a->nama,
          'kodeKat'=>strtoupper($a->kodeKat),
          'desKat'=>$a->desKat,
          'idUser'=>session()->get('idUser')
        ]);

        echo strtoupper($a->kodeKat);


        // $notif = tkat::where([
        //   'idUser'=>session()->get('idUser'),
        //   'kodeKat'=>strtoupper($a->kodeKat)
        //   ])->get();

          // session()->flash('berhasilTambahKat');
          // session()->flash('idKat',$notif[0]->id);

          // return redirect()->route('produk');
      }

    }

    public function update(request $a, $id)
    {
      $nama =  'nama'.$id;
      $kode =  'kodeKat'.$id;
      $des =  'desKat'.$id;
      // code...
      if ($a->changerKat == 0) {
        tkat::where([
          'idUser'=>session()->get('idUser'),
          'id'=>$id
          ])->update([
            'nama'=>$a->$nama,
            'kodeKat'=>strtoupper($a->$kode),
            'desKat'=>$a->$des,
          ]);

          session()->flash('berhasilUpdateKat');
          return redirect()->route('kate');
      }else {
        // code...
        $cekKat = tkat::where([
          'idUser'=>session()->get('idUser'),
          'kodeKat'=>$a->$kode
        ])->get();

        if (count($cekKat) > 0) {
          // code...
          session()->flash('gagalUpdateKat');
          return redirect()->route('kate');
        }else {
          // code...
          tkat::where([
            'idUser'=>session()->get('idUser'),
            'id'=>$id
            ])->update([
              'nama'=>$a->$nama,
              'kodeKat'=>strtoupper($a->$kode),
              'desKat'=>$a->$des,
            ]);

            session()->flash('berhasilUpdateKat');
            return redirect()->route('kate');
        }
      }
    }

    public function delete($id)
    {
      // code...
      tkat::destroy($id);

      session()->flash('berhasilHapusKat');
      return redirect()->route('kate');
    }
}
