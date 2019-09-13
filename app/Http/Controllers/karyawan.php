<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tuser;
use App\tset;
use App\tkar;
use Hash;

class karyawan extends Controller
{
    //
    public function index(){
        if (session()->get('idUser') && session()->get('level')=='admin'){
            // echo 'masuk admin';
            $isiUser = tuser::where([
            'id'=>session()->get('idUser')
            ])->get();

            $isiSet = tset::where([
            'idUser'=>session()->get('idUser')
            ])->get();

            return view('karyawan',[
                'user'=>$isiUser[0],
                'setting'=>$isiSet[0]
            ]);
        }else{
            return redirect()->route('masuk');
        }
    }


    public function tambah(Request $a)
    {
        $a->validate([
            'email'=>'email'
        ]);

        $cekEmailKar = tkar::where([
            'email'=>$a->email
        ])->count();

        $cekEmailUser = tuser::where([
            'email'=>$a->email
        ])->count();

        if($cekEmailKar > 0 || $cekEmailUser > 0){
            echo 'emailSudahAda';
        }else{
            tkar::create([
                'idUser'=>session()->get('idUser'),
                'nama'=>$a->nama,
                'email'=>$a->email,
                'password'=>$a->password,
                'level'=>$a->level
            ]);
        }
    }
    
    public function delete(request $a)
    {
        // dd('asjhgh');
        tkar::destroy($a->id);
    }

    public function load()
    {
        $ambil = tkar::where([
            'idUser'=>session()->get('idUser')
        ])->get();

        if (count($ambil) == 0) {
            echo 0;
        }else{
            return response()->json($ambil);
        }

    }
    

    public function nama(request $a)
    {
        return response()->json(tkar::find($a->id));
    }

    public function cekPassword(request $a)
    {
        $user = tuser::find(session()->get('idUser'));
        
        if(Hash::check($a->key, $user->password)){
            // dd('masuk');
            $kar = tkar::find($a->id);

            return response()->json($kar);
        }else{
            echo 0;
        }
    }

    public function getDataKaryawan($a)
    {
        $ambil = tkar::find($a);

        return response()->json($ambil);
    }
    
    public function update(Request $a)
    {
        $a->validate([
            'email'=>'email'
        ]);
        
        if($a->changerEmail == 1){

            $cekEmailKar = tkar::where([
                'email'=>$a->email
            ])->count();
    
            $cekEmailUser = tuser::where([
                'email'=>$a->email
            ])->count();
    
            if($cekEmailKar > 0 || $cekEmailUser > 0){
                echo 'emailSudahAda';
            }else{
                tkar::find($a->idKar)->update([
                    'nama'=>$a->nama,
                    'email'=>$a->email,
                    'level'=>$a->level
                ]);
            }
        }else{
            tkar::find($a->idKar)->update([
                'nama'=>$a->nama,
                'level'=>$a->level
            ]);
        }
    }
}
