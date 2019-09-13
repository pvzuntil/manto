@extends('lay.mas') 
@section('title') KATEGORI || MANTO @endsection
 
@section('css')
  @if ($setting->tema == '0')
      <style>
        form[name=tambahKat]>.input-field>input[type=text], form[name=tambahKat]>.input-field>textarea{
          color: white
        }
      </style>
  @endif
@endsection
 
@section('body') @if ($statusCo == 1)
<style>
  body{
    overflow: hidden;
  }
</style>
<div class="blocked red darken-4 center-align white-text">
  <div>
    <h5>PROSES TRANSAKSI SEDANG DILAKUKAN</h5>
    <p>Selama proses transaksi dilakukan, anda tidak bisa mengubah data produk dan kategori</p>
  </div>
  <div>
    @if (session()->get('level') == 'inv')
      <a href="{{route('keluar')}}" class="btn red darken-2">KELUAR <i class="material-icons left">open_in_new</i></a>
    @else
      <a href="{{route('home')}}" class="btn blue darken-2">HOME <i class="material-icons left">home</i></a>
    
    @endif
  </div>
</div>
@endif
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
    <li class="active">
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
    <li class="active">
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
        <a href="#" class="brand-logo">KATEGORI</a>
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
          <h5>Tambah kategori</h5>
        </div>
      </div>
      <form action="{{route('kateTambah')}}" method="post" class="row" name="tambahKat">
        <div class="col l6 m6 s12 input-field">
          <label for="nama">Nama Kategori</label>
          <input type="text" name="nama" id="nama" required>
        </div>
        <div class="col l6 m6 s12 input-field">
          <label for="kodeKat">Kode Kategori</label>
          <input type="text" name="kodeKat" id="kodeKat" required>
        </div>
        <div class="col l12 m12 s12 input-field">
          <label for="desKat">Deskripsi Kategori</label>
          <textarea name="desKat" rows="8" cols="80" class="materialize-textarea" id="desKat" data-length="120" required></textarea>
        </div>
        <div class="col" style="float:right;">
          <button type="button" name="button" class="btn waves-effect batalTrigger red darken-2 tooltiped" data-position="bottom" data-tooltip="Batal"><i class="material-icons">close</i></button>
          <button type="submit" name="" class="btn waves-effect blue darken-2 tooltiped" data-position="bottom" data-tooltip="Simpan"><i class="material-icons">check</i></button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
    {{-- SHORTING AN --}}
    {{-- <div id="fieldShort">
      <div class="row">
        <div class="col l6 m6 s12">
          <h6>Urutkan Berdasarkan</h6>
        </div>
        <div class="col l6 m6 s12">
          <h6>Urutkan Berdasarkan</h6>
        </div>
      </div>
    </div> --}}
    <!-- CONTENTTTTTTTTTTT -->
    <div class="row">
      <div class="col l12 m12 s12">
        {{-- <input type="text" value="{{ request()->cookie('kat-sort') }}"> --}}
        <table class="striped">
          <thead style="font-weight: bold;">
            <tr>
              <td>Kode</td>
              <td>Nama</td>
              <td>Deskripsi</td>
              <td>Aksi</td>
            </tr>
          </thead>

          <tbody>
            <!-- AWAL DATA -->
            @if (count($isiKat) == 0)
            <tr>
              <td colspan="4" class="center-align">Tidak ada data kategori, silahkan tambah beberapa</td>
            </tr>
            @else @foreach ($isiKat as $kat)
            <tr id="kat{{$kat->id}}" class="animated">
              <td>{{$kat->kodeKat}}</td>
              <td>{{$kat->nama}}</td>
              <td>{{$kat->desKat}}</td>
              <td>
                <button type="button" name="button" class="btn waves-effect orange darken-2 btnEdit modal-trigger tooltiped" data-position="bottom" data-tooltip="Edit"
                  data-target="modalEditKat{{$kat->id}}">
                            <i class="material-icons">create</i>
                          </button>
                <button type="button" name="button" class="btn waves-effect red darken-2 tooltiped" data-position="bottom" data-tooltip="Hapus" id="hapusKat{{$kat->id}}">
                            <i class="material-icons">delete</i>
                          </button>
              </td>
            </tr>
            <!-- MODAL MASING_MASING DATA -->
                <form action="/kate/{{$kat->id}}" method="post">
                  <div class="modal modal-fixed-footer" id="modalEditKat{{$kat->id}}">
                    <div class="modal-content">
                      <h4 class="center-on-small-only">EDIT KATEGORI {{strtoupper($kat->nama)}}</h4>
                      <div class="row">
                        <div class="input-field col l12 s12 m12">
                          <label for="">Nama Kategori</label>
                          <input type="text" name="nama{{$kat->id}}" id="" value="{{$kat->nama}}" required>
                        </div>
                        <div class="input-field col l12 s12 m12">
                          <label for="">Kode Kategori</label>
                          <input type="text" name="kodeKat{{$kat->id}}" id="kodeKat{{$kat->id}}" value="{{$kat->kodeKat}}" required>
                        </div>
                        <div class="input-field col l12 s12 m12">
                          <label for="">Deskripsi Kategori</label>
                          <textarea name="desKat{{$kat->id}}" rows="8" cols="80" class="materialize-textarea" data-length="120" required>{{$kat->desKat}}</textarea>
                        </div>
                      </div>
                      <input type="hidden" name="changerKat" value="0" id="kodeKatChanger{{$kat->id}}">
                    </div>
                    {{-- --}}
                    <script type="text/javascript">
                      $('#kodeKat{{$kat->id}}').on('change',function () {
                        $('#kodeKatChanger{{$kat->id}}').val('1');
                      });
                    </script>
                    {{-- --}}
                    <div class="modal-footer">
                      <a href="#" class="btn waves-effect modal-close red darken-2">
                        <i class="material-icons">close</i>
                      </a>
                      <button type="submit" name="" class="btn waves-effect blue darken-2">
                        <i class="material-icons right">check</i>SIMPAN
                      </button>
                    </div>
                  </div>
                  {{ csrf_field() }}
                </form>
                <!-- AKHIR MODEL -->
            @endforeach @endif
            <!-- AKHIR DATA -->
          </tbody>
        </table>
      </div>
    </div>


    <!-- AKHIR CONTENTER -->
  </div>
</main>
@endsection

@section('js')
<script src="/js/kategori.js"></script>
<script type="text/javascript">

    @foreach ($isiKat as $kat)
      $('#hapusKat{{$kat->id}}').click(function () {
        swal({
          title:'Peringatan !',
          type:'warning',
          text:'Apakan anda ingin menghapus {{$kat->nama}} .?',
          showCancelButton:true,
          cancelButtonText:'Batal'
        }).then((result)=>{
          if (result.value) {
            direct('/kate/{{$kat->id}}/delete');
          }
        })
      });
    @endforeach

  @if (session()->has('berhasilMasuk'))

      swal({
        title:'Berhasil !',
        type:'success',
        text:'Selamat datang kembali di toko anda !'
      });

    @endif

    @if (session()->has('berhasilTambahKat'))

      swal({
        title:'Berhasil !',
        type:'success',
        text:'Berhasil menambah kategori !'
      }).then((result)=>{
        if (result.value) {
          var posKat = $('#kat{{session()->get('idKat')}}').position();

          $('html, body').animate({
            scrollTop: posKat.top
          }, 'fast', function () {
            $('#kat{{session()->get('idKat')}}').addClass('flash');
          });
        }
      });

    @endif

    @if (session()->has('berhasilUpdateKat'))

      swal({
        title:'Berhasil !',
        type:'success',
        text:'Berhasil mengupdate kategori !'
      });

    @endif

    @if (session()->has('berhasilHapusKat'))

      swal({
        title:'Berhasil !',
        type:'success',
        text:'Berhasil menghapus kategori !'
      });

    @endif

    @if (session()->has('gagalTambahKat'))

      swal({
        title:'Gagal !',
        type:'error',
        text:'Gagal menambah kategori, kode kategori ada yang sama, silahkan ulangi sekali lagi !'
      });

    @endif


    @if (session()->has('gagalUpdateKat'))

      swal({
        title:'Gagal !',
        type:'error',
        text:'Gagal menambah kategori, kode kategori ada yang sama, silahkan ulangi sekali lagi !'
      });

    @endif

    @if($setting->tema == '0')
        $('.theming-body').addClass('grey darken-4');
        $('.collapsible-body').addClass('white-text');
        $('.striped').addClass('white-text');
        $('#fieldTambahKat').addClass('white-text');
        $('.helper-text').addClass('white-text');
      @endif
</script>
@endsection