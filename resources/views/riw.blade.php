@extends('lay.mas')


@section('title') RIWAYAT || MANTO @endsection

@section('css')
  <style media="screen">
    .pagination .page-item {
        display: inline-block;
        border-radius: 2px;
        text-align: center;
        vertical-align: top;
        height: 30px
    }

    .pagination .page-item .page-link {
        color: #444;
        display: inline-block;
        font-size: 1.2rem;
        padding: 0 10px;
        line-height: 30px
    }

    .pagination .page-item.active .page-link {
        color: #fff
    }

    .pagination .page-item.active {
        background-color: #0277bd
    }

    .pagination .page-item .disabled .page-link {
        cursor: default;
        color: #999
    }

    .pagination .page-item .page-link i {
        font-size: 2rem
    }

    .pagination .page-item.pages ul li {
        display: inline-block;
        float: none
    }
    /* .pagination{display:-ms-flexbox;display:flex;padding-left:0;list-style:none;border-radius:.25rem}.page-link{position:relative;display:block;padding:.5rem .75rem;margin-left:-1px;line-height:1.25;color:#007bff;background-color:#fff;border:1px solid #dee2e6}.page-link:hover{z-index:2;color:#0056b3;text-decoration:none;background-color:#e9ecef;border-color:#dee2e6}.page-link:focus{z-index:2;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.page-link:not(:disabled):not(.disabled){cursor:pointer}.page-item:first-child .page-link{margin-left:0;border-top-left-radius:.25rem;border-bottom-left-radius:.25rem}.page-item:last-child .page-link{border-top-right-radius:.25rem;border-bottom-right-radius:.25rem}.page-item.active .page-link{z-index:1;color:#fff;background-color:#007bff;border-color:#007bff}.page-item.disabled .page-link{color:#6c757d;pointer-events:none;cursor:auto;background-color:#fff;border-color:#dee2e6}.pagination-lg .page-link{padding:.75rem 1.5rem;font-size:1.25rem;line-height:1.5}.pagination-lg .page-item:first-child .page-link{border-top-left-radius:.3rem;border-bottom-left-radius:.3rem}.pagination-lg .page-item:last-child .page-link{border-top-right-radius:.3rem;border-bottom-right-radius:.3rem}.pagination-sm .page-link{padding:.25rem .5rem;font-size:.875rem;line-height:1.5}.pagination-sm .page-item:first-child .page-link{border-top-left-radius:.2rem;border-bottom-left-radius:.2rem}.pagination-sm .page-item:last-child .page-link{border-top-right-radius:.2rem;border-bottom-right-radius:.2rem} */
    .cardPadding{
      padding: 4% !important;
      display:grid;
      grid-column-gap: 10px;
      grid-template-columns: auto auto;
      border-radius: 3px;
      margin-top: 10px;
    } 
    .cardKiri{
      width: 100%;
    }
    .cardKanan{
      width: 100%;
    }
    .iconCard{
      font-size: 40px;
      padding: 15px;
      border-radius: 50%;
      background-color: rgba(57, 121, 193, 0.63);
    }
  </style>

@endsection

@section('body')
<input type="hidden" name="_token" id="_tokenLaravel" value="{{csrf_token()}}">
<input type="hidden" name="" id="_namaToko" value="{{strtoupper($user->namaToko)}}">

  <ul class="sidenav sidenav-fixed" id="sidenav">
    <li>
      <div class="navbar-fixed">
        <nav class="@if ($setting->tema == 1)
            blue darken-3
            @else
            grey darken-4
        @endif">
          <div class="navbar-wrapper">
            <a href="#" class="brand-logo" style="font-size: 20px;">{{substr($user->namaToko,0,11)}}</a>
          </div>
        </nav>
      </div>
    </li>
    <li>
      <div class="user-view">
        <div class="background">
          <img src="{{$setting->imgSampul}}" alt="">
        </div>
        <img src="{{$setting->imgProfil}}" alt="" class="circle materialboxed">
        <a href="#" class="white-text name">
        @if (session()->get('level') == 'admin')
          ADMINISTRATOR  
        @elseif(session()->get('level') == 'kasir')
          KASIR
        @elseif(session()->get('level') == 'inv')
          INVENTOR
        @endif  
      </a>
      <a href="#" class="white-text email">
        {{session()->get('email')}}
      </a>
      </div>
    </li>
    {{-- MENU MENU MENU MENU MENU MENU MENU --}}
  @if(session()->get('level') == 'admin')
    <li>
      <a class="waves-effect waves-dark" href="{{route('home')}}"><i class="material-icons left">home</i>Dashboard</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('produk')}}"><i class="material-icons left">all_inbox</i>Produk</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('kate')}}"><i class="material-icons left">local_offer</i>Kategori</a>
    </li>
    <li class="active">
      <a class="waves-effect waves-dark" href="{{route('riwayat')}}"><i class="material-icons left">history</i>Riwayat</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('karyawan')}}"><i class="material-icons left">people</i>Karyawan</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('pengaturan')}}"><i class="material-icons left">settings</i>Pengaturan</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="#" id="btnKeluar"><i class="material-icons left">open_in_new</i>Keluar</a>
    </li>
  @elseif(session()->get('level') == 'inv')
    <li>
      <a class="waves-effect waves-dark" href="{{route('produk')}}"><i class="material-icons left">all_inbox</i>Produk</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('kate')}}"><i class="material-icons left">local_offer</i>Kategori</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="#" id="btnKeluar"><i class="material-icons left">open_in_new</i>Keluar</a>
    </li>
  @elseif(session()->get('level') == 'kasir')
    <li>
      <a class="waves-effect waves-dark" href="{{route('home')}}"><i class="material-icons left">home</i>Dashboard</a>
    </li>
    <li class="active">
      <a class="waves-effect waves-dark" href="{{route('riwayat')}}"><i class="material-icons left">history</i>Riwayat</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="#" id="btnKeluar"><i class="material-icons left">open_in_new</i>Keluar</a>
    </li>
  @endif
  {{-- IKLAN IKLAN IKLAN IKLAN --}}
  </ul>

  <!--  -->

  <header>
    <div class="navbar-fixed">
      <nav class="@if ($setting->tema == 1)
            blue darken-3
            @else
            grey darken-4
        @endif">
        <div class="navbar-wrapper">
          <a href="#" class="sidenav-trigger" data-target="sidenav"><i class="material-icons">menu_vert</i></a>
          <a href="#" class="brand-logo">TRANSAKSI</a>
        </div>
      </nav>
    </div>
  </header>

  <main>
    <div class="container-fluid">
      <!-- AKHIR CONTENTER -->
      @if(session()->get('level') == 'admin')
        <div class="row" style="display:none" loaded="0" id="rowStat">
          <div class="col l6 m12 s12 center-align">
            <canvas id="chartPemasukan"></canvas>
          </div>
          <div class="col l6 m12 s12 center-align">
            <canvas id="chartPenjualan"></canvas>
          </div>
          <div class="col l6 m12 s12">
            {{-- <canvas id="chartPemasukan"></canvas> --}}
            
            <div class="blue darken-3 cardPadding white-text">
              <div class="cardKiri">
                <i class="material-icons iconCard">
                  account_circle
                </i>
                <p>Total Transaksi</p>
              </div>
              <div class="cardKiri right-align">
                <h5 id="totalTransaksiMasuk">654</h5>
                <p style="margin: 0 !important;">Transaksi</p>
                <p id="totalTransaksiHariIni">+ 30 Hari Ini</p>
              </div>
            </div>
          </div>
          <div class="col l6 m12 s12">
            {{-- <canvas id="chartPenjualan"></canvas> --}}
            <div class="blue darken-3 cardPadding white-text">
              <div class="cardKiri">
                <i class="material-icons iconCard">
                  all_inbox
                </i>
                <p>Total Produk</p>
              </div>
              <div class="cardKiri right-align">
                <h5 id="totalProdukMasuk">2909</h5>
                <p style="margin: 0 !important;">Produk</p>
                <p id="totalProdukBulanIni">+ 30 Hari Ini</p>
              </div>
            </div>
          </div>
          <div class="col l12 m12 s12" style="padding-top: 10px">
            <a href="/laporanHarian" target="_blank" class="btn blue darken-2 waves-effect waves-dark" style="width: 100%;" >CETAK LAPORAN HARIAN</a>
          </div>
        </div>
        <div class="row" style="padding-top:20px;">
          <div class="col l12 m12 s12">
            <button class="btn right btn-small" id="btnStat"><i class="material-icons left">timeline</i> STATISTIK</button>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col l12 m12 s12">
          @if (count($pel) == 0)
              <div class="card-panel">
                Tidak ada transaksi sama sekali!
              </div>
          @else
            <ul class="collapsible collection">
              @foreach ($pel as $p)
                <li riwayat-id="{{$p->id}}" id="riwayat{{$p->id}}" riwayat-kodePembelian="{{$p->kodePembelian}}" data-type="kodePembelian" riwayat-loaded="0">
                  <div class="collapsible-header">
                    <i class="material-icons">account_box</i>
                    <span class="bold" style="text-transform:capitalize">{{$p->nama}}</span>
                    {{-- <div style="display:flex; align-items:flex-end; justify-content:flex-end; width:50%">
                      <span class="" style="text-transform:capitalize;">{{$p->nama}}</span>
                    </div> --}}
                    {{-- <div class="secondary-content"><i class="material-icons">star</i></div> --}}
                  </div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col l6 m6 s6">
                        <small>Daftar Pembelian</small>
                      </div>
                      <div class="col l6 m6 s6">
                        <small class="right">{{$p->created_at->diffForHumans()}}</small>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <table class="striped">
                          <thead>
                            <tr class="bold">
                              <td>
                                Banyak
                              </td>
                              <td>
                                Nama Barang
                              </td>
                              <td>
                                Harga Satuan
                              </td>
                              <td>
                                Jumlah
                              </td>
                            </tr>
                          </thead>
                          <tbody id="{{$p->id}}" riwayat-target="{{$p->kodePembelian}}">
                            {{--  --}}
                          </tbody>
                        </table>
                        <hr>
                        <button class="btn red darken-2 btn-small" id="hapus{{$p->id}}" idd="{{$p->id}}" riwayat-kodePembelian="{{$p->kodePembelian}}">HAPUS<i class="material-icons right">delete</i></button>
                        <a href="/print-{{$p->kodePembelian}}" target="_blank" class="btn btn-small">NOTA<i class="material-icons right">event_note</i></a>
                        {{-- <a href="/print-{{$p->kodePembelian}}/pdf" class="btn btn-small"><i class="material-icons left">file_download</i>EXPORT PDF</a> --}}
                        <small>*Data yang ditampilkan adalah data dimana produk itu dibeli pada saat itu</small>
                      </div>
                    </div>
                  </div>
                </li>
                <script>
                  $('#hapus{{$p->id}}').on('click', function(){
                    var kodePembelian = $(this).attr('riwayat-kodePembelian');
                    var id = $(this).attr('idd');

                    swal({
                      text:'Apakah anda ingin menghapus {{$p->nama}} ?',
                      title:'Peringatan !',
                      type:'warning',
                      showCancelButton:true,
                      cancelButtonText:'Batal',
                      confirmButtonText:'Ya',
                    }).then((result)=>{
                      if(result.value){
                        direct('/riwayat-'+id+'-'+kodePembelian+'');
                      }
                    });
                  });
                </script>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col l6 m6 s6">
          {{-- <p>{{$pel->count()}} Data ditampilkan || {{$pel->total()}} Total data</p> --}}
        </div>
        <div class="col l6 m6 s6 right-align">
          {{$pel->links()}}
        </div>
      </div>
    </div>
  </main>
@endsection

@section('js')
<script src="/asset/chart/c.js"></script>
{{-- <script src="/asset/prev/prev.js" charset="utf-8"></script> --}}
<script src="/js/riwayat.js"></script>
  <script type="text/javascript">
    $(function() {

      @if(session()->has('berhasilMenghapusRiwayat'))
        swal({
          title:'Berhasil',
          text:'Berhasli Menghapus Riwayat',
          type:'success'
        });

      @endif


      @if($setting->tema == '0')
        $('.theming-body').addClass('grey darken-4');
        $('.collapsible-body').addClass('white-text');
      @endif

    });
  
  </script>
@endsection
