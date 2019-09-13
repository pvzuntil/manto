<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tuser;
use App\this;
use App\tpel;

class laporanHarian extends Controller
{
    //
    public function index(Request $a)
    {
    	if (session()->get('idUser') && session()->get('level') == 'admin') {
			$ambilUser = tuser::where('id',session()->get('idUser'))->get();
			$ambilHis = this::whereRaw('EXTRACT(DAY FROM created_at) = DAY(CURDATE())')->where('idUser', session()->get('idUser'))->get();
			$ambilTotal = this::selectRaw('SUM(harga*banyak) AS sip')->whereRaw('EXTRACT(DAY FROM created_at) = DAY(CURDATE())')->where('idUser', session()->get('idUser'))->get();

			$jumlah = this::selectRaw('SUM(banyak) AS jum, SUM(harga*banyak) AS jumHarga, SUM(hargaBeli * banyak) AS jumHargaBeli')->where('idUser', session()->get('idUser'))->get();

			// dd($ambilTotal);

			// dd($ambilUser[0]->namaToko);
			// dd(session()->get('idUser'));
    		return view('laporanHarian',[
				'user'=>$ambilUser[0],
				'riw'=>$ambilHis,
				'tot'=>$ambilTotal[0],
				'jumlahBarang'=>$jumlah[0]
			]);
     	}else {
        	return redirect()->route('masuk');
     	}
    }
}
