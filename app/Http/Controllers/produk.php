<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

use App\tuser;
use App\tset;
use App\tkat;
use App\tpro;

use App\tco;

class produk extends Controller
{
    //
    public function index()
    {
      if (session()->get('idUser') && session()->get('level') == 'admin' || session()->get('level') == 'inv') {
        $co = tco::where([
          'idUser'=>session()->get('idUser')
        ])->get();
  
        if(count($co)>0){

          $isiUser = tuser::where([
            'id'=>session()->get('idUser')
          ])->get();
  
          $isiSet = tset::where([
            'idUser'=>session()->get('idUser')
          ])->get();
  
          $ambilKat = tkat::where([
            'idUser'=>session()->get('idUser')
          ])->orderby('nama', 'asc')->get();
  
          $ambilProduk = tpro::where([
            'idUser'=>session()->get('idUser')
          ])->orderBy('created_at','asc')->get();
  
          $statusCo = 1;
          return view('produk',[
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'isiKat'=>$ambilKat,
            'isiPro'=>$ambilProduk,
            'statusCo'=>$statusCo
          ]);
          
        }else{
          $isiUser = tuser::where([
            'id'=>session()->get('idUser')
          ])->get();
  
          $isiSet = tset::where([
            'idUser'=>session()->get('idUser')
          ])->get();
  
          $ambilKat = tkat::where([
            'idUser'=>session()->get('idUser')
          ])->orderby('nama', 'asc')->get();
  
          $ambilProduk = tpro::where([
            'idUser'=>session()->get('idUser')
          ])->orderBy('created_at','asc')->get();
  
          $statusCo = 0;
          return view('produk',[
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'isiKat'=>$ambilKat,
            'isiPro'=>$ambilProduk,
            'statusCo'=>$statusCo
          ]);
        }
        
      }else {
        return redirect()->route('masuk');
      }
    }

    public function tambah(request $a)
    {
      $a->validate([
        'imgPro'=>'max:2000'
      ]);

      $cekProduk = tpro::where([
        'idUser'=>session()->get('idUser'),
        'kode'=>strtoupper($a->kode),
        'idKat'=>$a->idKat
      ])->get();

      if (count($cekProduk) >0) {

        session()->flash('gagalTambahProduk');
        return redirect()->route('produk');
      }else {
        $findKat = tkat::find($a->idKat);

        if ($a->hasFile('imgPro')) {
          // code...
          $file = $a->file('imgPro');
          $lokasiFile = '/imgPro/';
          $namaFile = time().'.'.$file->getClientOriginalExtension();

          $file->move('imgPro', $namaFile);

          tpro::create([
            'idUser'=>session()->get('idUser'),
            'nama'=>$a->nama,
            'harga'=>$a->harga,
            'hargaBeli'=>$a->hargaBeli,
            'idKat'=>$a->idKat,
            'kode'=>strtoupper($a->kode),
            'fullkode'=>strtoupper($findKat->kodeKat.$a->kode),
            'stok'=>$a->stok,
            'stokawal'=>$a->stok,
            'img'=>$lokasiFile.$namaFile
          ]);

          $ambilPro = tpro::where([
            'idUser'=>session()->get('idUser'),
            'kode'=>strtoupper($a->kode)
          ])->get();
          session()->flash('idPro',$ambilPro[0]->id);

          session()->flash('berhasilTambahProduk');

          return redirect()->route('produk');
        }else {
          tpro::create([
            'idUser'=>session()->get('idUser'),
            'nama'=>$a->nama,
            'harga'=>$a->harga,
            'hargaBeli'=>$a->hargaBeli,
            'idKat'=>$a->idKat,
            'kode'=>strtoupper($a->kode),
            'fullkode'=>strtoupper($findKat->kodeKat.$a->kode),
            'stok'=>$a->stok,
            'stokawal'=>$a->stok,
            'img'=>'/ico/semiLarge/barang.png'
          ]);

          $ambilPro = tpro::where([
            'idUser'=>session()->get('idUser'),
            'kode'=>strtoupper($a->kode)
          ])->get();
          session()->flash('idPro',$ambilPro[0]->id);

          session()->flash('berhasilTambahProduk');
          return redirect()->route('produk');
        }
      }
    }

    public function delete($id)
    {
      tpro::destroy($id);

      session()->flash('berhasilHapusProduk');
      return redirect()->route('produk');
    }

    public function update(request $a, $id)
    {
      $a->validate([
        'harga'=>'gte:hargaBeli'
      ]);

      $findKat = tkat::find($a->idKat);
      
      if ($a->changerPro == 1) {
        // code...
        $cekProduk = tpro::where([
          'idUser'=>session()->get('idUser'),
          'kode'=>strtoupper($a->kode),
          'idKat'=>$a->idKat
        ])->get();

        if (count($cekProduk) > 0) {
          // code...
          session()->flash('gagalUpdateProduk');
          return redirect()->route('produk');
        }else {
          // code...
          if ($a->hasFile('imgPro')) {
            // code...
            $file = $a->file('imgPro');
            $lokasiFile = '/imgPro/';
            $namaFile = time().'.'.$file->getClientOriginalExtension();

            $file->move('imgPro', $namaFile);

            tpro::where([
              'idUser'=>session()->get('idUser'),
              'id'=>$id
              ])->update([
                'idUser'=>session()->get('idUser'),
                'nama'=>$a->nama,
                'harga'=>$a->harga,
                'hargaBeli'=>$a->hargaBeli,
                'idKat'=>$a->idKat,
                'kode'=>strtoupper($a->kode),
                'fullkode'=>strtoupper($findKat->kodeKat.$a->kode),
                'stok'=>$a->stok,
                'stokawal'=>$a->stok,
                'img'=>$lokasiFile.$namaFile
              ]);

              session()->flash('berhasilUpdateProduk');

              return redirect()->route('produk');
            }else {
              tpro::where([
                'idUser'=>session()->get('idUser'),
                'id'=>$id
                ])->update([
                  'idUser'=>session()->get('idUser'),
                  'nama'=>$a->nama,
                  'harga'=>$a->harga,
                  'hargaBeli'=>$a->hargaBeli,
                  'idKat'=>$a->idKat,
                  'kode'=>strtoupper($a->kode),
                  'fullkode'=>strtoupper($findKat->kodeKat.$a->kode),
                  'stok'=>$a->stok,
                  'stokawal'=>$a->stok,
                  // 'img'=>$lokasiFile.$namaFile
                ]);

                session()->flash('berhasilUpdateProduk');

                return redirect()->route('produk');
            }
        }
      }else {
        // code...
        if ($a->hasFile('imgPro')) {
          // code...
          $file = $a->file('imgPro');
          $lokasiFile = '/imgPro/';
          $namaFile = time().'.'.$file->getClientOriginalExtension();

          $file->move('imgPro', $namaFile);

          tpro::where([
            'idUser'=>session()->get('idUser'),
            'id'=>$id
            ])->update([
              'idUser'=>session()->get('idUser'),
              'nama'=>$a->nama,
              'harga'=>$a->harga,
              'hargaBeli'=>$a->hargaBeli,
              'idKat'=>$a->idKat,
              'kode'=>strtoupper($a->kode),
              'stok'=>$a->stok,
              'stokawal'=>$a->stok,
              'img'=>$lokasiFile.$namaFile
            ]);

            session()->flash('berhasilUpdateProduk');

            return redirect()->route('produk');
          }else {
            tpro::where([
              'idUser'=>session()->get('idUser'),
              'id'=>$id
              ])->update([
                'idUser'=>session()->get('idUser'),
                'nama'=>$a->nama,
                'harga'=>$a->harga,
                'hargaBeli'=>$a->hargaBeli,
                'idKat'=>$a->idKat,
                'kode'=>strtoupper($a->kode),
                'stok'=>$a->stok,
                'stokawal'=>$a->stok,
                // 'img'=>$lokasiFile.$namaFile
              ]);

              session()->flash('berhasilUpdateProduk');

              return redirect()->route('produk');
          }
      }
    }
}
