<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\tkat;

class ajaxKategori extends Controller
{
    //
    public function loadKategori()
    {
        $ambil = tkat::where([
            'idUser'=>session()->get('idUser')
        ])->orderBy('created_at','asc')->get();


        return response()->json($ambil);

        // $out = '';

        // if(count($ambil) == 0){
        //     $out .= '
        //         <select class="select" name="idKat" id="idKat">
        //             <optgroup label="Kategori kosong, silahkan tambah di menu kategori"></optgroup>
        //             <option value="addKat" data-icon="/add.png">Tambah kategori baru</option>
        //         </select>
        //         <label for="idKat">Pilih Kategori</label>

        //     ';
        // }else{

        //     $out .= '
        //         <select class="select" name="idKat" id="idKat">       
        //     ';

        //     foreach($ambil as $a){
        //         $out .='
                
        //             <optgroup label="Kode - '.$a->kodeKat.'">
        //                 <option value="'.$a->id.'">'.$a->nama.'</option>
        //             </optgroup>

        //         ';
        //     }

        //     $out .='
        //             <option value="addKat" data-icon="/add.png">Tambah kategori baru</option>
        //         </select>
        //         <label for="idKat">Pilih Kategori</label>

        //     ';
        // }

        // echo $out;
    }
}
