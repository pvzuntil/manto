<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\this;
use App\tpel;
use App\tuser;

use PDF;

class printNota extends Controller
{
    //
    public function index($kodePembelian){
        if(session()->has('idUser')){

            $user = tuser::find(session()->get('idUser'));

            $ambil = tpel::where([
                'idUser'=>session()->get('idUser'),
                'kodePembelian'=>$kodePembelian
            ])->get();

            $barang = this::where([
                'kodePembelian'=>$kodePembelian
            ])->get();

            if(count($ambil) == 0){
                abort(404);
            }else{
                
                return view('nota',[
                    'user'=>$user,
                    'nota'=>$ambil[0],
                    'barang'=>$barang
                ]);
            }



        }
    }

    public function pdf($kodePembelian)
    {
        // # code...
        // $user = tuser::find(session()->get('idUser'));

        //     $ambil = tpel::where([
        //         'idUser'=>session()->get('idUser'),
        //         'kodePembelian'=>$kodePembelian
        //     ])->get();

        //     $barang = this::where([
        //         'kodePembelian'=>$kodePembelian
        //     ])->get();
            

        //     $pdf = PDF::loadView('pdf',[
        //         'user'=>$user,
        //         'nota'=>$ambil[0],
        //         'barang'=>$barang
        //     ]);

        //     return $pdf->download('nota');


        if(session()->has('idUser')){

            $user = tuser::find(session()->get('idUser'));

            $ambil = tpel::where([
                'idUser'=>session()->get('idUser'),
                'kodePembelian'=>$kodePembelian
            ])->get();

            $barang = this::where([
                'kodePembelian'=>$kodePembelian
            ])->get();


            return view('notaPDF',[
                'user'=>$user,
                'nota'=>$ambil[0],
                'barang'=>$barang
            ]);

        }
    }
}
