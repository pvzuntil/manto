@extends('lay.mas') 
@section('title') NOTA DARI {{$nota->nama}}
@endsection
 
@section('css')
<link rel="stylesheet" href="/asset/sem/kom/button.min.css"> {{--
<script src="/asset/sem/kom/search.min.js" charset="utf-8"></script> --}}
<style>
  .sa{
    background-image:url(/lunas.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain; 
  }
  @media print{
    .no{
      display: none;
    }
  }  
</style>
@endsection
 
@section('body')
<div class="container">
  <div class="row">
    <div class="col l6 m6 s6">
      <h4>{{strtoupper($user->namaToko)}}</h4>
    </div>
    <div class="col l6 m6 s6">
      <a href="#" class="btn waves-effect btn-small right no" style="margin-top:25px" onclick="print()"><i class="material-icons left">print</i>Cetak</a>
    </div>
  </div>
  <div class="row">
    <div class="col l12 m12 s12">
      <p class="bold">BUKTI PEMBAYARAN</p>
      <p>Diterbitkan oleh</p>
    </div>
    <div class="col l2 m2 s2">
      <p class="bold">Toko</p>
      <p class="bold">Kode</p>
      <p class="bold">Tanggal</p>
    </div>
    <div class="col l4 m4 s4">
      <p>{{$user->namaToko}}</p>
      <p>PMB{{substr($nota->kodePembelian,-4)}}</p>
      <p>{{$nota->created_at}}</p>
    </div>
    <div class="col l2 m2 s2">
      <p class="bold">Kepada</p>
    </div>
    <div class="col l4 m4 s4">
      <p>{{$nota->nama}}</p>
    </div>
  </div>
  <hr>
  <table class="striped">
    <thead>
      <tr class="bold">
        <td>Nama Barang</td>
        <td>Banyak</td>
        <td>Harga Satuan</td>
        <td>Jumlah</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($barang as $b)
          <tr>
            <td>{{$b->nama}}</td>
            <td>{{$b->banyak}}</td>
            <td>Rp. {{number_format($b->harga,0,'.','.')}}</td>
            <td>Rp. {{number_format($b->harga*$b->banyak,0,'.','.')}}</td>
          </tr>
      @endforeach
      <tr>
          <td></td>
          <td></td>
          <td class="bold">Total</td>
          <td>Rp. {{number_format($nota->total,0,'.','.')}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="bold">Bayar</td>
          <td>Rp. {{number_format($nota->bayar,0,'.','.')}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="bold">Kembalian</td>
          <td>Rp. {{number_format($nota->bayar - $nota->total,0,'.','.')}}</td>
        </tr>
    </tbody>
  </table>
  <small>*Semua barang yang sudah dibeli tidak dapat ditukar atau dikembalikan</small>
</div>
@endsection
 
@section('js')
  <script>
    $(function(){
      $('body').addClass('sa');
    });
  </script>
@endsection