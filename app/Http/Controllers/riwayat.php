<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\tset;
use App\tuser;
use App\tpel;
use App\this;


class riwayat extends Controller
{
    //
    public function index(){
        if (session()->get('idUser') && session()->get('level') == 'admin' || session()->get('level') == 'kasir') {
        // code...
            $isiUser = tuser::where([
            'id'=>session()->get('idUser')
            ])->get();

            $isiSet = tset::where([
            'id'=>session()->get('idUser')
            ])->get();

            $isiPel = tpel::where([
                'idUser'=>session()->get('idUser')
            ])->orderBy('created_at', 'desc')->paginate(10);

            return view('riw',[
            'user'=>$isiUser[0],
            'setting'=>$isiSet[0],
            'pel'=>$isiPel,
            ]);
        }else {
            return redirect()->route('masuk');
        }
    }

    public function hapus($id, $kodePembelian)
    {
        // dd($id.'   '.$kodePembelian);
        
        tpel::destroy($id);
        this::where([
            'kodePembelian'=>$kodePembelian
        ])->delete();

        session()->flash('berhasilMenghapusRiwayat');
        return redirect()->route('riwayat');
    }
}
