@extends('lay.mas') 
@section('title') KARYAWAN || MANTO @endsection
 
@section('css')
<link rel="stylesheet" href="/asset/sem/kom/button.min.css"> {{--
<script src="/asset/sem/kom/search.min.js" charset="utf-8"></script> --}}
<script src="/asset/screenfull.min.js"></script>


@if($setting->tema =='0')
  <style>
    #closeRes{
      color: black;
    }
  </style>
@endif

@endsection
 
@section('body')
<input type="hidden" name="_token" id="_tokenLaravel" value="{{csrf_token()}}">
<input type="hidden" name="_token" id="_userEmail" value="{{$user->email}}">
<input type="hidden" name="_token" id="_userPassword" value="{{$user->password}}">


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
    <li>
      <a class="waves-effect waves-dark" href="{{route('home')}}"><i class="material-icons left">home</i>Dashboard</a>
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
    <li class="active">
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
        <a href="#" class="brand-logo">KARYAWAN</a>
      </div>
    </nav>
  </div>
</header>

<main>
  <div class="fixed-action-btn">
    <a href="#" class="btn-floating waves-effect btn-large red tambahTrigger scale-transition" data-position="bottom" data-tooltip="Tambah baru">
        <i class="material-icons">add</i>
      </a>
      {{-- <ul>
        <li title="URUTKAN"><a href="#" class="btn waves-effect-floating teal"><i class="material-icons">filter_list</i></a></li>
      </ul> --}}
  </div>

  <div class="container-fluid">
    <div id="fieldTambahKat" style="display:none;" class="">
      <div class="row" action="" method="post">
        <div class="col l12 m12 s12">
          <h5>Tambah Karyawan</h5>
        </div>
      </div>
      <form action="{{route('tambahKaryawan')}}" method="post" class="row" name="tambahKat">
        <div class="col l6 m6 s12 input-field">
          <label for="nama">Nama Karyawan</label>
          <input class="validate" type="text" name="nama" id="nama" required>
        </div>
        <div class="col l6 m6 s12 input-field">
          <select name="level" id="level" required class="validate">
            <option value="" disabled selected>Pilih opsi</option>
            <option value="kasir">Kasir</option>
            <option value="inv">Inventor</option>
          </select>
          <label for="">Tingkat Karyawan</label>
        </div>
        <div class="col l12 m12 s12 input-field">
          <label for="email">Email Karyawan</label>
          <input class="validate" type="email" name="" id="email" required>
          <span class="helper-text">Digunakan untuk login karyawan</span>
        </div>
        <div class="col l6 m12 s12 input-field">
          <label for="pass">Password Karyawan</label>
          <input class="validate" type="password" name="" id="password" required>
        </div>
        <div class="col l6 m12 s12 input-field">
          <label for="passwordKon">Password Konfirmasi Karyawan</label>
          <input class="validate" type="password" name="" id="passwordKon" required>
        </div>
        <div class="col" style="float:right;">
          <button type="button" name="button" class="btn waves-effect batalTrigger red darken-2 tooltiped" data-position="bottom" data-tooltip="Batal" id="btnBatal"><i class="material-icons">close</i></button>
          <button type="button" name="" class="btn waves-effect blue darken-2 tooltiped" data-position="bottom" data-tooltip="Simpan" id="submitKaryawan"><i class="material-icons">check</i></button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
    <div class="row">
      <div class="col l12 m12 s12">
        <table class="striped">
          <thead style="font-weight: bold;">
            <tr>
              <td>Nama Karyawan</td>
              <td>Email</td>
              {{-- <td>Password</td> --}}
              <td>Level</td>
              <td>Aksi</td>
            </tr>
          </thead>

          <tbody id="fieldKar">
            
          </tbody>
        </table>
      </div>
    </div>


    <!-- AKHIR CONTENTER -->
  </div>
</main>

<div class="modal " id="modalShowPassword">
  <div class="modal-content">
    <h4 class="modal-header" id="headerShowPassword">Password</h4>
    <form class="row">
      <div class="col l12 m12 s12 input-field">
        <i class="material-icons prefix">vpn_key</i>
        <label for="passwordUser">Password</label>
        <input type="password" name="" id="passwordUser" idKar="">
        <span class="helper-text" id="helperPasswordUser">*Masukkan password anda</span>
      </div>
      <div class="col l12 m12 s12 right-align">
        <button type="button" class="btn green darken-2" id="lihatBtn">Lihat</button>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-close btn red darken-2">Tutup</a>
  </div>
</div>
{{--  --}}
<div class="modal modal-fixed-footer" id="modalEditKaryawan">
  <div class="modal-content">
    <h4 class="modal-header" id="headerEditKaryawan">Edit Karyawan</h4>
    <form class="row">
      <div class="col l6 m12 s12">
        <label for="editNama">Nama Karyawan</label>
        <input type="text" id="editNama">
      </div>
      <div class="col l6 m12 s12 input-field">
        <label for="editLabel"></label>
        <select id="editLevel" class="browser-default">
          <option value="kasir" id="optionEditKasir">Kasir</option>
          <option value="inv" id="optionEditInv">Inventor</option>
        </select>
      </div>
      <div class="col l12 m12 s12">
        <label for="editEmail">Email Karyawan</label>
        <input type="email" id="editEmail">
      </div>
      {{-- <div class="col l6 m12 s12 input-field">
        <label for="editPassword">Password Karyawan</label>
        <input type="password" id="editPassword">
      </div>
      <div class="col l6 m12 s12 input-field">
        <label for="editPasswordKon">Konfirmasi Karyawan</label>
        <input type="password" id="editPasswordKon">
      </div> --}}
      <input type="hidden" name="" id="changerEmail" value="">
      <input type="hidden" name="" id="idKar" value="">
      {{-- <input type="text" name="" id="changerPassword" value=""> --}}
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn modal-close red darken-2" id="btnBatalEditKaryawan">Batal</button>
    <button id="submitEditKaryawan" class="btn blue darken-2">Simpan</button>
  </div>
</div>



@endsection

@section('js')
<script src="/js/karyawan.js"></script>
<script>
  @if($setting->tema == '0')
      $('.theming-body').addClass('grey darken-4');
      $('.collapsible-body').addClass('white-text');
      $('.container-fluid').addClass('white-text');
      $('#fieldTambahKat').addClass('white-text');
      $('.helper-text').addClass('white-text');
      $('input.select-dropdown').addClass('white-text');
  @endif
</script>

@endsection