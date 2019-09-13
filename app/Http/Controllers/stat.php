<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tpel;
use App\tpro;

use DB;

class stat extends Controller
{
    //
    public function load(){
        $pel = tpel::where([
            'idUser'=>session()->get('idUser')
        ])->count();

        $pro = tpro::where([
            'idUser'=>session()->get('idUser')
        ])->count();

        $perubahanPel = tpel::whereRaw('EXTRACT(DAY FROM created_at) = DAY(CURDATE())')->count();
        $perubahanPro = tpro::whereRaw('EXTRACT(MONTH FROM created_at) = MONTH(CURDATE())')->count();
        
        // dd($perubahanPel);

        $fix = [$pel, $pro, $perubahanPel, $perubahanPro];
        
        // dd($fix);
        return response()->json($fix);
    }
}
