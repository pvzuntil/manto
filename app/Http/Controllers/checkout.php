<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use Session;

use App\tco;
use App\tpro;
use App\tpel;
use App\this;

class checkout extends Controller
{
    //
    public function add($id)
    {
        tco::create([
            'idUser' => session()->get('idUser'),
            'idPro' => $id,
            'banyak' => '1'
        ]);

        return redirect(url()->previous());
    }
    public function tambah()
    {
        $banyakStok = tpro::find($_GET['id']);

        if ($banyakStok->stok > 0) {

            $cari = tco::where([
                'idPro' => $_GET['id'],
                'idUser' => session()->get('idUser')
            ])->get();

            if (count($cari) > 0) {
                tco::where([
                    'idPro' => $_GET['id'],
                    'idUser' => session()->get('idUser')
                ])->update([
                    'banyak' => $cari[0]->banyak + 1
                ]);

                $ambilDataStok = tpro::find($_GET['id']);

                tpro::where([
                    'idUser' => session()->get('idUser'),
                    'id' => $_GET['id']
                ])->update([
                    'stok' => $ambilDataStok->stok - 1
                ]);
            } else {
                tco::create([
                    'idUser' => session()->get('idUser'),
                    'idPro' => $_GET['id'],
                    'banyak' => '1'
                ]);

                $ambilDataStok = tpro::find($_GET['id']);

                $stok = $ambilDataStok->stok;

                tpro::where([
                    'idUser' => session()->get('idUser'),
                    'id' => $_GET['id']
                ])->update([
                    'stokawal' => $stok,
                    'stok' => $stok - 1
                ]);
            }
        } else { }
    }

    public function sum()
    {
        $ambil = tco::where([
            'idUser' => session()->get('idUser')
        ])->orderBy('created_at', 'desc')->get();

        if (count($ambil) > 0) {
            $out = '

        <table class="striped" border="1">
          <thead>
            <tr class="bold">
              <td>
                Nama Barang
              </td>
              <td>
                Harga
              </td>
              <td>
                Banyak
              </td>
              <td>
                Total
              </td>
            </tr>
          </thead>

          <tbody>

        ';


            foreach ($ambil as $a) {
                $out .= '

          <tr>
            <td>' . $a->tpro->nama . '</td>
            <td>Rp. ' . number_format($a->tpro->harga, 0, '.', '.') . '</td>
            <td>' . $a->banyak . '</td>
            <td>Rp. ' . number_format($a->banyak * $a->tpro->harga, 0, '.', '.') . '</td>
          </tr>


          ';
            }

            $out .= '

          </tbody>
        </table>

        ';

            echo $out;
        } else if (count($ambil) == 0) {
            $out = '

        <table class="striped" border="1">
          <thead>
            <tr class="bold">
              <td>
                Nama Barang
              </td>
              <td>
                Harga
              </td>
              <td>
                Banyak
              </td>
            </tr>
          </thead>
            <tr>
              <td colspan="3" class="center-align">Lakukan Transsaksi Doeloe !</td></td>
            </tr>

          <tbody>

        ';

            $out .= '

          </tbody>
        </table>

        ';

            echo $out;
        }
    }

    public function theRealCheckOut(request $a)
    {
        $kodePembelian = time();

        $innerJoin = tco::join('tpros', 'tcos.idPro', '=', 'tpros.id')->selectRaw('tcos.*, tpros.*')->whereRaw('tcos.idUser = ' . session()->get('idUser'))->get();
        $jumlah = 0;

        foreach ($innerJoin as $data) {
            $hi = $data->harga * $data->banyak;
            $jumlah = $jumlah + $hi;
        }


        if ($a->namaPelanggan == '') {
            tpel::create([
                'idUser' => session()->get('idUser'),
                'nama' => 'Seorang pelanggan yang baik',
                'kodePembelian' => $kodePembelian,
                'total' => $jumlah,
                'bayar' => $a->bayar
            ]);

            $ambilCo = tco::where([
                'idUser' => session()->get('idUser')
            ])->orderBy('created_at', 'desc')->get();

            foreach ($ambilCo as $co) {
                this::create([
                    'idUser' => session()->get('idUser'),
                    'kodePembelian' => $kodePembelian,
                    'nama' => $co->tpro->nama,
                    'harga' => $co->tpro->harga,
                    'hargaBeli' => $co->tpro->hargaBeli,
                    'banyak' => $co->banyak
                ]);
            }
            tco::where([
                'idUser' => session()->get('idUser')
            ])->delete();

            Cookie::queue('end', '1');
            Session::put([
                'kodePembelian' => $kodePembelian
            ]);

            echo '1';
        } else {

            tpel::create([
                'idUser' => session()->get('idUser'),
                'nama' => $a->namaPelanggan,
                'kodePembelian' => $kodePembelian,
                'total' => $jumlah,
                'bayar' => $a->bayar
            ]);

            $ambilCo = tco::where([
                'idUser' => session()->get('idUser')
            ])->orderBy('created_at', 'desc')->get();

            foreach ($ambilCo as $co) {
                this::create([
                    'idUser' => session()->get('idUser'),
                    'kodePembelian' => $kodePembelian,
                    'nama' => $co->tpro->nama,
                    'harga' => $co->tpro->harga,
                    'hargaBeli' => $co->tpro->hargaBeli,
                    'banyak' => $co->banyak
                ]);
            }
            tco::where([
                'idUser' => session()->get('idUser')
            ])->delete();

            Cookie::queue('end', '1');
            Session::put([
                'kodePembelian' => $kodePembelian
            ]);

            echo '1';
        }
    }

    public function end()
    {
        if (Cookie::get('end') == 1) {
            Cookie::queue('end', '0');
            session()->flash('transaksiSelesai');
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
}
