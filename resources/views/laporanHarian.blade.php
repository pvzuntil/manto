@extends('lay.mas')

@section('title') LAPORAN HARI INI @endsection

@section('css')
  <style>
    @media print{
      .no{
        display: none;
      }
    }    

  </style>   
@endsection

@section('body')
  <div class="container" style="padding-bottom:20px">
    <div class="row" style="padding-top:20px;">
      <div class="col l9 m9 s9">
        <h5 class="left-align"> LAPORAN HARIAN TOKO {{strtoupper($user->namaToko)}}</h5>
      </div>
      <div class="col l3 m3 s3">
        <button class="btn blue darken-3 right no" onclick="window.print()"><i class="material-icons left">print</i> CETAK</button>
      </div>
    </div>

    <div class="row">
      <div class="col l6 m6 s6">
        <table class="striped">
          <tr>
            <td class="bold">Nama Toko</td>
            <td>:</td>
            <td>{{$user->namaToko}}</td>
          </tr>
          <tr>
            <td class="bold">Nama Pemilik</td>
            <td>:</td>
            <td>{{$user->nama}}</td>
          </tr>
          <tr>
            <td class="bold">Tanggal</td>
            <td>:</td>
            <td>{{now()}}</td>
          </tr>
        </table>
      </div>
    </div>

    <table class="striped">
      <thead>
        <tr class="bold">
          <td>Nomer Transaksi</td>
          <td>Nama Barang</td>
          <td>Jumlah</td>
          <td>Harga Jual</td>
          {{--  <td>Harga Beli</td>  --}}
          <td>Total</td>
          {{--  <td>HARGA BELI</td>  --}}
        </tr>
      </thead>
      <tbody>
        @if(count($riw)==0)
          <tr class="center-align">
            <td colspan="5" class="center">Data kosong untuk hari ini</td>
          </tr>
        @else
          @foreach ($riw as $r)
            <tr>
              <td>{{$r->kodePembelian}}</td>
              <td>{{$r->nama}}</td>
              <td>{{$r->banyak}}</td>
              <td>Rp. {{number_format($r->harga,0,'.','.')}}</td>
              {{--  <td>Rp. {{number_format($r->hargaBeli,0,'.','.')}}</td>  --}}
              <td>Rp. {{number_format($r->harga*$r->banyak,0,'.','.')}}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
      <tfoot class="bold">
        <tr>
          <td colspan="2" class="center-align">Jumlah</td>
          <td>{{$jumlahBarang->jum}}</td>
          {{--  <td>Rp. {{number_format($jumlahBarang->jumHarga,0,'.','.')}}</td>  --}}
          <td></td>
          {{--  <td>Rp. {{number_format($jumlahBarang->jumHargaBeli,0,'.','.')}}</td>  --}}
          <td>
            Rp. {{number_format($tot->sip,0,'.','.')}}
          </td>
        </tr>
        <tr>
          <td class="center" colspan="6">KEUNTUNGAN HARI INI</td>
        </tr>
        <tr>
          <td class="center" colspan="6">Rp. {{number_format($jumlahBarang->jumHarga - $jumlahBarang->jumHargaBeli,0,'.','.')}}</td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection
