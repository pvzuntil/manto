@extends('lay.mas') 
@section('title') BERANDA || MANTO @endsection
 
@section('css')
<link rel="stylesheet" href="/asset/sem/kom/button.min.css"> {{--
<script src="/asset/sem/kom/search.min.js" charset="utf-8"></script> --}}
<script src="/asset/screenfull.min.js"></script>
{{-- <script src="/asset/matauang/matauang.js"></script> --}}


@if($setting->tema =='0')
  <style>
    #closeRes{
      color: black;
    }
  </style>
@endif

@endsection
 
@section('body')
{{--  {{$baca}}  --}}


<input type="hidden" name="_token" id="_tokenLaravel" value="{{csrf_token()}}">
{{--  --}}
<div class="fixed-action-btn">
  <a class="btn-floating red" title="Layar Penuh" id="fullScreenBtn">
    <i class="large material-icons" id="iconFullScreen">fullscreen</i>
  </a>
  {{-- <ul>
    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  </ul> --}}
</div>

<ul class="sidenav sidenav-fixed overH" id="sidenav">
  <li>
    <div class="navbar-fixed">
      <nav class="@if ($setting->tema == 1)
            blue darken-3
            @else
            grey darken-4
        @endif">
        <div class="navbar-wrapper">
          <a href="/pengaturan?namaToko" class="brand-logo" style="font-size: 20px;">{{substr($user->namaToko,0,11)}}</a>
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
    <li class="active">
      <a class="waves-effect waves-dark" href="#"><i class="material-icons left">home</i>Dashboard</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('produk')}}"><i class="material-icons left">all_inbox</i>Produk</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('kate')}}"><i class="material-icons left">local_offer</i>Kategori</a>
    </li>
    <li>
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
    <li class="active">
      <a class="waves-effect waves-dark" href="#"><i class="material-icons left">home</i>Dashboard</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('riwayat')}}"><i class="material-icons left">history</i>Riwayat</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="#" id="btnKeluar"><i class="material-icons left">open_in_new</i>Keluar</a>
    </li>
  @endif
  {{-- IKLAN IKLAN IKLAN IKLAN --}}
  <li class="no-padding disNo">
      <div class="card @if ($setting->tema == 1)
            blue darken-3
            @else
            grey darken-4
        @endif">
        <div class="card-content white-text">
          <span class="card-title">Iklan</span>
          <p>
            Beberapa iklan dari google akan diletakkan di sini
          </p>
        </div>
      </div>
  </li>
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
        <a href="#" class="brand-logo">BERANDA</a>
      </div>
    </nav>
  </div>
</header>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col l12 m12 s12">
        {{-- <form class="" action="" method=""> --}}
          <div class="input-field">
            <i class="material-icons prefix">search</i>
            <label for="key">Masukkan nama barang atau kode barang</label>
            <input type="text" name="key" id="key" value="" style="@if($setting->tema == '0') color:white; @endif"> 
            {{ csrf_field() }}
          </div>
        {{-- </form> --}}

        <div id="result" style="position:absolute; display:none; z-index:2">

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col l10 m10 s12">
        <p>
          Total Bayar <br>
          <span style="font-size: 50px;" id="fieldJumlah">Rp. 0 ,-</span><br> Jumlah Barang <button class="ui button mini"
            disabled id="jumlahBanyakBarang" style="z-index:0;">0</button> Buah
        </p>
        <!-- <p style="font-size: 50px;">RP. TOTAL HARGA,-</p> -->
      </div>
      <div class="col l2 m2 s12" style="height: 100% !important;">
        <br><br>
        <button class="btn waves-effect modal-trigger" data-target="checkOut" style="width:100%" id="btnCheckOut">BAYAR</button>
      </div>
    </div>

    {{-- TABLE COOOOOOOOOOOOOOOOOOUUUUTTTT --}}

    <div class="row">
      <div class="col l12 s12 m12" id="isiDataCo">
        <div id="loaderDataCo" class="center-align">
          <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>

            <div class="spinner-layer spinner-red">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>

            <div class="spinner-layer spinner-yellow">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>

            <div class="spinner-layer spinner-green">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
        {{--
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

          </tbody>
        </table> --}}
      </div>
    </div>

  </div>
  {{--  {{$baca}}  --}}
{{--  {{session()->get('kodePembelian')}}  --}}
{{--  sas  --}}
</main>

@if ($baca == 1)
<button type="button" id="modalBaca" class="btn waves-effect modal-trigger" data-target="terms" name="button" style="display:none">BACA</button>
<div class="modal modal-fixed-footer" id="terms">
  <div class="modal-content modalContent" style="text-align:justify">
    <h4 id="titleModal">SYARAT DAN KETENTUAN</h4>
    <div class="divider"></div><br>
    Selamat datang di MANTO (Manajemen Toko)
    <br>
    <br>
    Syarat & ketentuan yang ditetapkan di bawah ini mengatur pemakaian jasa yang ditawarkan oleh PT. ManTo terkait penggunaan situs. Pengguna disarankan membaca dengan seksama karena dapat berdampak kepada hak dan kewajiban Pengguna di bawah hukum.
    <br>
    <br>
    Dengan mendaftar dan/atau menggunakan situs ManTo, maka pengguna dianggap telah membaca, mengerti, memahami dan menyutujui semua isi dalam Syarat & ketentuan. Syarat & ketentuan ini merupakan bentuk kesepakatan yang dituangkan dalam sebuah perjanjian yang sah antara Pengguna dengan PT. ManTo. Jika pengguna tidak menyetujui salah satu, sebagian, atau seluruh isi Syarat & ketentuan, maka pengguna tidak diperkenankan menggunakan layanan di tersebut.
    <br>
    <br>
    Syarat dan ketentuan sewaktu-waktu dapat berubah sesuai perjanjian.
    <br>
    <form action="#">
      <p>
        <label>
          <input type="checkbox" id="paramCheck" class="filled-in"/>
          <span>Dengan ini, saya setuju dengan persyaratan yang berlaku</span>
        </label>
      </p>
    </form>
  </div>
  <div class="modal-footer">
    <a href="{{route('keluar')}}" class="btn waves-effect red darken-2">TIDAK SETUJU <i class="material-icons right">close</i></a>
    <a href="{{route('confirm')}}" id="btnSetuju" class="btn waves-effect blue darken-2 disabled">SETUJU <i class="material-icons right">check</i></a>
  </div>
</div>



@endif
<div class="modal modal-fixed-footer" id="checkOut">
  <div class="modal-content">
    <h3>SELESAIKAN PEMBAYARAN ANDA</h3>
    <hr>
    <div class="row">
      <div class="col l6 m6 s12">
        <small>Total Bayar</small>
        <h4 id="jumlahAkhir">Rp. Sekian</h4>
      </div>
      <div class="col l6 m6 s12">
        <small>Kembalian</small>
        <h4 class="teal-text">Rp. <span id="kembalian">0</span> ,-</h4>
      </div>
    </div>
    <div class="row">
      <div class="col s12 l12 m12">
        <div class="input-field">
          <label for="bayar">Bayar</label>
          <input type="number" name="" id="bayar" min="0">
        </div>
      </div>
      <div class="col l12 m12 s12">
        <div class="input-field">
          <label for="namaPelanggan">Nama Pembeli</label>
          <input type="text" name="" id="namaPelaggan">
          <span class="helper-text">Boleh dikosongi</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12 l12 m12" id="ringkasanCheckOut">
        <div class="progress" id="loadingDataCo">
          <div class="indeterminate"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn waves-effect red darken-2 modal-close">BATAL</a>
    <a href="#" class="btn waves-effect disabled" id="lastBtn">BAYAR !</a>
  </div>
</div>
@endsection
 
@section('js')

<script type="text/javascript">

  $(()=>{
    @if (session()->has('berhasilMasuk'))

        swal({
          title:'Berhasil !',
          type:'success',
          text:'Selamat datang kembali di toko anda !'
        });

      @endif

      @if (session()->has('transaksiSelesai'))

        swal({
          title:'Berhasil !',
          type:'success',
          text:'Transaksi terselasikan dengan aman  !',
          confirmButtonText:'Cetak',
          showCancelButton:true,
          cancelButtonText:'Tutup',
        }).then((result)=>{
          if(result.value){
            window.open('/print-{{session()->get("kodePembelian")}}',"_blank", "width=700,height=500,resizable=0");
          }
        });

      @endif

      @if($setting->tema == '0')
          $('.theming-body').addClass('grey darken-4');
          $('.collapsible-body').addClass('white-text');
          $('.container-fluid').addClass('white-text');
          $('#fieldTambahKat').addClass('white-text');
          $('.helper-text').addClass('white-text');
      @endif
  });

</script>
<script src="/js/home.js"></script>
@if($baca == 1)
  <script>
    $(document).ready(function(){
      $('#modalBaca').click();
      $('.modal-overlay').attr('id','overlayModal');
      $('#overlayModal').click(function(){
        $('#modalBaca').click();
      });
    });
  </script>
@endif

@endsection