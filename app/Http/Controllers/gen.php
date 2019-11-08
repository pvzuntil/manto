<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tpro;
use App\tco;
use App\this;
use App\tpel;

use DB;


class gen extends Controller
{
    //
    public function index($id)
    {
        if ($id == '') {
            // code...
            $ambilData = '';
            return response()->json($ambilData);
        } else {
            // code...
            $ambilData = tpro::where([
                'idUser' => session()->get('idUser')
            ])
                ->where('nama', 'like', '%' . $id . '%')
                ->orWhere('kode', 'like', '%' . $id . '%')
                ->get();


            return response()->json($ambilData);
        }
    }

    public function post(Request $a)
    {
        if ($a->get('query')) {
            $key = $a->get('query');

            $data = tpro::where('nama', 'like', '%' . $key . '%')
                ->orWhere('kode', 'like', '%' . $key . '%')
                ->orWhere('fullkode', 'like', '%' . $key . '%')
                ->where([
                    'idUser' => session()->get('idUser')
                ])
                ->get();

            if (count($data) == 0) {
                $out = '
          <ul class="collection">

            <a href="#" class="red-text collection-item">Tidak ada data yang ditemukan !</a>

          </ul>


          ';
            } elseif (count($data) > 0) {
                // code...
                $out = '
          <ul class="collection">
            <li class="collection-item" id="closeRes"><i class="material-icons" style="cursor:pointer">close</i></li>
          ';
                foreach ($data as $a) {


                    if ($a->stok > 0) {
                        if ($a->idUser == session()->get('idUser')) {

                            $out .= '
                <a href="#" data-type="produk" id="' . $a->id . '" class="collection-item black-text" style="display:flex; justify-content:flex-start; align-items:center">

                <div class="thumPro" style="background-image:url(' . $a->img . ')"></div>

                <div style="margin-left:10px" class="title">' . strtoupper($a->nama) . '
                <br>
                <small class="teal-text">' . strtoupper($a->tkat->kodeKat . $a->kode) . '</small>
                <br>
                Rp. ' . number_format($a->harga, 0, '.', '.') . '
                </div>

                </a>
                ';
                        }
                    } else {
                        if ($a->idUser == session()->get('idUser')) {

                            $out .= '
                <a href="#" data-type="" id="' . $a->id . '" class="collection-item black-text" style="display:flex; justify-content:flex-start; align-items:center">

                <div class="thumPro" style="background-image:url(' . $a->img . ')"></div>

                <div style="margin-left:10px" class="title">' . strtoupper($a->nama) . '
                <br>
                <small class="teal-text">' . strtoupper($a->tkat->kodeKat . $a->kode) . '</small>
                <br>
                Rp. ' . number_format($a->harga, 0, '.', '.') . '
                <br><small class="red-text">Produk kosong</small>
                </div>

                </a>
                ';
                        }
                    }
                }
                $out .= '
          </ul>
          ';
            }

            echo $out;
        }
    }

    public function loadData()
    {
        $co = tco::where([
            'idUser' => session()->get('idUser')
        ])->orderBy('created_at', 'desc')->get();


        if (count($co) == 0) {
            // code...
            $out = '
            <table class="striped">
              <thead style="font-weight:bold">
                <tr>
                  <td colspan="2">Nama Barang</td>
                  <td>Harga</td>
                  <td>Banyak</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody id="tbody">
                <tr>
                  <td colspan="5" class="center-align">Tidak ada transaksi untuk kali ini</td>
                </tr>
              </tbody>
            </table>

        ';
        } else {
            // code...
            $out = '

        <table class="striped">
          <thead style="font-weight:bold">
            <tr>
              <td colspan="2">Nama Barang</td>
              <td>Harga</td>
              <td>Banyak</td>
              <td>Aksi</td>
            </tr>
          </thead>
          <tbody id="tbody">



        ';
            foreach ($co as $c) {
                $out .= '
            <tr>
              <td>
              <div class="thumPro" style="background-image:url(' . $c->tpro->img . ')"></div>
              </td>
              <td>
              ' . $c->tpro->nama . '
              </td>
              <td>
              Rp. ' . number_format($c->tpro->harga, 0, '.', '.') . ' ,-
              </td>
              <td>
                <div class="mini ui buttons" id="parentTarget">
                <button class="mini ui red button" id="btnKurangBanyak" target-id-kurang="' . $c->id . '" target-produk="' . $c->tpro->id . '"><i class="ui icon minus"></i></button>
                <button class="mini ui button" nama-target="banyak' . $c->id . '" id="target' . $c->id . '">' . $c->banyak . '</button>
                <button class="mini ui green button" id="btnTambahBanyak" target-id-tambah="' . $c->id . '" target-produk="' . $c->tpro->id . '"><i class="ui icon arrow plus"></i></button>
                </div>
              </td>
              <td>
                <button type="button" class="btn waves-effect red darken-2" id-pro="' . $c->id . '" data-type="btnHapusProCo"><i class="material-icons">delete</i></button>
              </td>
            </tr>

          ';
            }

            $out .= '

            </tbody>
          </table>

        ';
        }

        echo $out;
    }

    public function deleteData($id)
    {

        $findCoPro = tco::find($id);

        $findPro = tpro::find($findCoPro->idPro);

        tpro::where([
            'id' => $findCoPro->idPro,
            'idUser' => session()->get('idUser')
        ])->update([
            'stok' => $findPro->stokawal
        ]);

        tco::destroy($id);
    }

    public function hitungTotalHarga()
    {
        // $innerJoin = tco::join('tpros','tcos.idPro','=','tpros.id')
        //                   ->select(DB::raw('tcos.*, tpros.*'))
        //                   ->where('tcos.idUser',2)->get();

        // dd($innerJoin);


        // $innerJoin = DB::raw('SELECT tcos.*, tpros.*, SUM(tpros.harga * tcos.banyak) as jumlah FROM tcos INNER JOIN tpros ON tcos.idPro = tpros.id WHERE tcos.idUser = ' . session()->get('idUser') . '');
        $innerJoin = tco::join('tpros', 'tcos.idPro', '=', 'tpros.id')->selectRaw('tcos.*, tpros.*')->whereRaw('tcos.idUser = ' . session()->get('idUser'))->get();
        $jumlah = 0;
        return response()->json($innerJoin);

        echo 'Rp. ' . number_format($result['jumlah'], 0, '.', '.') . ' ,-';
    }

    public function hitungTotalHarga2()
    {
        // $innerJoin = tco::join('tpros','tcos.idPro','=','tpros.id')
        //                   ->select(DB::raw('tcos.*, tpros.*'))
        //                   ->where('tcos.idUser',2)->get();

        // dd($innerJoin);

        $innerJoin = pg_query($koneksi, 'SELECT tcos.*, tpros.*, SUM(tpros.harga * tcos.banyak) as jumlah FROM tcos INNER JOIN tpros ON tcos.idPro = tpros.id WHERE tcos.idUser = ' . session()->get('idUser') . '');
        $result = pg_fetch_array($innerJoin);

        echo $result['jumlah'];
    }

    public function updateBanyakBarangTambah(request $a)
    {

        $produk = tpro::find($a->produk);
        $co = tco::find($a->id);

        if ($produk->stok > 0) {

            $co->update([
                'banyak' => $co->banyak + 1
            ]);

            $res = $produk->stokawal - $co->banyak;

            $produk->update([
                'stok' => $res
            ]);

            echo $co->banyak;
        } else {
            echo 'pass';
        }
    }

    public function updateBanyakBarangKurang(request $a)
    {
        $produk = tpro::find($a->produk);
        $co = tco::find($a->id);

        // dd($produk);

        $co->update([
            'banyak' => $co->banyak - 1
        ]);

        $res = $produk->stokawal - $co->banyak;

        $produk->update([
            'stok' => $res
        ]);

        echo $co->banyak;
    }

    public function loadJumlahBanyakBarang()
    {
        $innerJoin = pg_query($koneksi, 'SELECT sum(tcos.banyak) as jadi FROM tcos WHERE idUser = ' . session()->get('idUser') . '');
        $result = pg_fetch_array($innerJoin);

        if ($result['jadi'] == null) {
            echo '0';
        } else {
            echo $result['jadi'];
        }
    }

    public function riwayatPembelian(request $a)
    {
        $his = this::where([
            'kodePembelian' => $a->kodePembelian,
            'idUser' => session()->get('idUser')
        ])->get();

        $pel = tpel::find($a->idRiwayat);

        $out = '';

        foreach ($his as $h) {
            $out .= '

          <tr>
            <td>' . $h->banyak . '</td>
            <td>' . $h->nama . '</td>
            <td>Rp. ' . number_format($h->harga, 0, '.', '.') . ' ,-</td>
            <td>Rp. ' . number_format($h->harga * $h->banyak, 0, '.', '.') . ' ,-</td>
          </tr>

        ';
        }

        $out .= '

        <tr>
          <td></td>
          <td></td>
          <td class="bold">Total</td>
          <td>Rp. ' . number_format($pel->total, 0, '.', '.') . ' ,-</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="bold">Bayar</td>
          <td>Rp. ' . number_format($pel->bayar, 0, '.', '.') . ' ,-</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="bold">Kembalian</td>
          <td>Rp. ' . number_format($pel->bayar - $pel->total, 0, '.', '.') . ' ,-</td>
        </tr>

      ';

        echo $out;
    }

    public function loadChart()
    {
        $a = DB::table('tpels')
            ->select(DB::raw('EXTRACT(DAY FROM created_at) AS tanggal, COUNT(*) AS banyakTanggal, SUM(total) AS banyakPemasukan'))
            ->where('idUser', session()->get('idUser'))
            ->whereRaw('EXTRACT(MONTH FROM created_at) = MONTH(CURDATE())')
            ->orderBy('created_at', 'asc')
            ->groupBy('tanggal')
            // ->limit(10)
            ->get();

        return response()->json($a);
    }
}
