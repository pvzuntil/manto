@extends('lay.mas') 
@section('title') PRODUK || MANTO @endsection
 
@section('css')

  {{-- <link rel="stylesheet" href="/asset/ds/ds.css"> --}}
  {{-- <link rel="stylesheet" href="/asset/sem/kom/table.min.css"> --}}
  {{-- <script src="/asset/ds/ds.js"></script> --}}

  @if ($setting->tema == '0')
      <style>
        .input-field>input[type=text], .input-field>input[type=number]{
          color: black
        }
      </style>
  @endif

  {{-- <link rel="stylesheet" href="/asset/sem/kom/dropdown.min.css">
  <script src="/asset/sem/kom/dropdown.min.js"></script> --}}
@endsection
 
@section('body') 
<input type="hidden" name="_token" id="_tokenLaravel" value="{{csrf_token()}}">


@if ($statusCo == 1)
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
    <li class="active">
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
    <li class="active">
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
        <a href="#" class="brand-logo">PRODUK</a>
      </div>
    </nav>
  </div>
</header>

<main>
  <div class="fixed-action-btn scale-transition">
    <a href="#" class="btn-floating btn-large red tambahTrigger" data-position="bottom" data-tooltip="Tambah baru">
      <i class="material-icons">add</i>
    </a>
    <ul>
      {{-- <li title="URUTKAN"><a href="#" class="btn-floating teal"><i class="material-icons">filter_list</i></a></li> --}}
    </ul>
  </div>
  {{-- FIELD APAA YA TESERAHLAH !!!!!!!!!!! CONTENTTTTTTTTTTTTTTTTTTTTTTTTTTTT-- TAMBAH KAT --}}
  <div class="container-fluid">
    <div id="fieldTambahKat" style="display:none;" class="">
      <div class="row" action="" method="post">
        <div class="col l12 m12 s12">
          <h5>Tambah Produk</h5>
        </div>
      </div>
      <form action="{{route('produkTambah')}}" method="post" class="row" enctype="multipart/form-data">
        <div class="col l12 m12 s12 input-field">
          <label for="nama">Nama Produk</label>
          <input type="text" name="nama" id="nama" required>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="material-icons prefix">attach_money</i>
          <label for="harga">Harga Jual</label>
          <input type="number" name="harga" id="harga" required min="0">
        </div>
        <div class="col l6 m6 s12 input-field">
          {{--  <i class="material-icons prefix">attach_money</i>  --}}
          <label for="hargaBeli">Harga Beli</label>
          <input type="number" name="hargaBeli" id="hargaBeli" required min="0">
        </div>
        <div class="col l12 m12 s12 input-field disNo">
          {{--  <i class="material-icons prefix">attach_money</i>  --}}
          {{-- <label for="hargaBeli">Harga Beli</label> --}}
          <input type="hidden" placeholder="minus" name="" id="hargaChecker" required min="0">
        </div>
        <div class="col l4 m4 s12" id="fieldKat">
          <div class="preloader-wrapper small active disNo" id="loading"><div class="spinner-layer spinner-blue"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-red"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-yellow"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-green"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>
          <label for="idKat">Kategori Produk</label>
          <select class="browser-default" name="idKat" id="idKat" style="border:none">
            {{-- <option value="" disabled selected>Pilih Kategori</option> --}}
                        {{-- @if (count($isiKat) == 0)
                        <optgroup label="Kategori kosong, silahkan tambah di menu kategori"></optgroup>
                        @else
                        @foreach ($isiKat as $kat)
                        <optgroup label="Kode - {{$kat->kodeKat}}">
                            <option value="{{$kat->id}}">{{$kat->nama}}</option>
                        </optgroup>
                        @endforeach
                        @endif --}}
            </select>
          {{-- <label for="idKat">Pilih Kategori</label> --}}
        </div>
        <div class="col l8 m8 s12 input-field">
          <label for="kode">Kode Produk</label>
          <input type="text" name="kode" id="kode">
        </div>
        <div class="col l4 m4 s12">
          <label for="stok">Stok Produk</label>
          <input type="number" name="stok" id="stok" required min="1">
        </div>
        <div class="col l8 m8 s12 file-field input-field">
          <div class="btn">
            <span>PILIH GAMBAR</span>
            <input type="file" accept="image/*" name="imgPro">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Pilih gambar produk">
          </div>
          <div class="helper-text">Boleh dikosongi</div>
        </div>
        <div class="col" style="float:right;">
          <button type="button" name="button" class="btn batalTrigger red darken-2 tooltiped" data-position="bottom" data-tooltip="Batal"><i class="material-icons">close</i></button>
          <button type="submit" name="" class="btn blue darken-2 disabled" data-position="bottom" data-tooltip="Simpan" id="simpanPro"><i class="material-icons">check</i></button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
    <!-- CONTENTTTTTTTTTTT -->
    <div class="row">
      <div class="col l12 m12 s12">
        <table class="striped" id="tableProduk">
          <thead style="font-weight: bold;">
            <tr>
              <td>Kode Produk</td>
              <td colspan="2">Nama Produk</td>
              <td>Harga <i class="material-icons right">arrow_drop_down</i></td>
              <td>Kategori</td>
              <td>Stok</td>
              <td>Aksi</td>
            </tr>
          </thead>

          <tbody>
            <!-- AWAL DATA -->
            @if (count($isiPro) == 0)
            <tr>
              <td colspan="7" style="text-align:center">Tidak ada data produk, Silahkan tambah bebrapa</td>
            </tr>
            @else @foreach ($isiPro as $pro)
            <tr id="produk{{$pro->id}}" class="animated @if($pro->stok < 1) red darken-4  white-text @endif">
              <td>{{$pro->tkat->kodeKat.$pro->kode}}</td>
              <td>
                <div class="thumPro left" style="background-image:url({{$pro->img}})"></div>
              </td>
              <td>{{$pro->nama}}</td>
              <td>Rp. {{number_format($pro->harga,0,'.','.')}},-</td>
              <td>{{$pro->tkat->nama}}</td>
              <td class="@if($pro->stok < 1) red-text @endif">{{$pro->stok}}</td>
              <td>
                <button type="button" name="" class="btn orange darken-2 tooltiped modal-trigger" data-target="modalProduk{{$pro->id}}" data-tooltip="Edit">
                                    <i class="material-icons">create</i>
                                </button>
                <button type="button" name="" class="btn red darken-2 tooltiped" data-tooltip="Hapus" id="hapusPro{{$pro->id}}">
                                    <i class="material-icons">delete</i>
                                </button>
              </td>
            </tr>
            @endforeach @endif
            <!-- AKHIR DATA -->
          </tbody>
        </table>
      </div>
    </div>
    {{-- MODEL PRODUK --}} @foreach ($isiPro as $pro)
    <div class="modal modal-fixed-footer" id="modalProduk{{$pro->id}}">
      <form class="row" action="/produk/{{$pro->id}}" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <h4>EDIT PRODUK {{$pro->nama}}</h4>
          <div class="col l12 m12 s12 input-field">
            <label for="nama">Nama Produk</label>
            <input type="text" name="nama" id="nama" required value="{{$pro->nama}}">
          </div>
          <div class="col l6 m6 s12 input-field">
            <i class="material-icons prefix">attach_money</i>
            <label for="hargaEdit">Harga</label>
            <input type="number" name="harga" id="hargaEdit" required min="0" value="{{$pro->harga}}">
          </div>
          <div class="col l6 m6 s12 input-field">
            {{--  <i class="material-icons prefix">attach_money</i>  --}}
            <label for="hargaBeliEdit">Harga Beli</label>
            <input type="number" name="hargaBeli" id="hargaBeliEdit" required min="0" value="{{$pro->hargaBeli}}">
          </div>
          <div class="col l4 m4 s12 input-field">
            <select class="select" name="idKat" id="idKat{{$pro->id}}">
                            @if (count($isiKat) == 0)
                            <optgroup label="Kategori kosong, silahkan tambah di menu kategori"></optgroup>
                            @else
                            @foreach ($isiKat as $kat)
                            <optgroup label="Kode - {{$kat->kodeKat}}">
                                <option value="{{$kat->id}}" @if ($pro->idKat == $kat->id)
                                    selected
                                    @endif

                                    >{{$kat->nama}}</option>
                            </optgroup>
                            @endforeach
                            @endif
                        </select>
            <label for="idKat">Pilih Kategori</label>
          </div>
          <div class="col l8 m8 s12 input-field">
            <label for="kode">Kode Produk</label>
            <input type="text" name="kode" id="kode{{$pro->id}}" value="{{$pro->kode}}">
          </div>
          <div class="col l4 m4 s12">
            <label for="stok">Stok Produk</label>
            <input type="number" name="stok" id="stok" required min="0" value="{{$pro->stok}}">
          </div>
          <div class="col l8 m8 s12 file-field input-field">
            <div class="btn">
              <span>PILIH GAMBAR</span>
              <input type="file" accept="image/*" name="imgPro" id="imgProFile{{$pro->id}}">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" id="imgProPlainText{{$pro->id}}" placeholder="Pilih gambar produk" value="<?php $pecah = explode('/', $pro->img);echo $pecah[2];?>">
            </div>
            <div class="helper-text">Boleh dikosongi</div>
          </div>
          <div class="col l12 m12 s12">
            <div class="thumPro" id="imgProReal{{$pro->id}}" style="background-image:url({{$pro->img}});width:300px;height:300px"></div>
            <div class="thumImg" id="imgProEditPrev{{$pro->id}}" style="display:none"></div>
          </div>
          <input type="hidden" name="changerPro" value="0" id="changerKodePro{{$pro->id}}">
        </div>
        {{-- --}}
        <script type="text/javascript">
          $('#idKat{{$pro->id}}, #kode{{$pro->id}}').change(function () {
                        $('#changerKodePro{{$pro->id}}').val('1');
                    });
        </script>
        {{-- --}}
        <div class="modal-footer">
          <button class="modal-close btn red darken-2" type="button">BATAL</button>
          <input type="submit" class="btn blue darken-2" value="SIMPAN" name="">
        </div>
        {{ csrf_field() }}
      </form>
    </div>
    @endforeach

    <!-- AKHIR CONTENTER -->
    <button class="btn modal-trigger disNo" data-target="tambahKategori" id="modalTambahKategoriBtn">aaa</button>
  </div>

  <div class="modal bottom-sheet modal-fixed-footer" id="tambahKategori">
    {{-- <form action="{{route('kateTambahInPro')}}" method="post" class="row"> --}}
      <div class="modal-content">
        <h4>Tambah Kategori</h4>

        <div class="row">
            <div class="col l6 m6 s12 input-field">
              <label for="namaKat">Nama Kategori</label>
              <input type="text" class="black-text" name="nama" id="namaKat" required>
            </div>
            <div class="col l6 m6 s12 input-field">
              <label for="kodeKat">Kode Kategori</label>
              <input type="text" class="black-text" name="kodeKat" id="kodeKat" required>
            </div>
            <div class="col l12 m12 s12 input-field">
              <label for="desKat">Deskripsi Kategori</label>
              <textarea name="desKat" rows="8" cols="80" class="materialize-textarea" id="desKat" data-length="120" required></textarea>
            </div>
            {{ csrf_field() }}
          </div>
        </div>
        <div class="modal-footer">
          {{-- <p>IKEHh</p> --}}
          {{-- <div class="col" style="float:right;"> --}}
            <button type="button" name="button" class="btn modal-close red darken-2" data-position="bottom" data-tooltip="Batal" id="btnBatalTambahKategori"><i class="material-icons">close</i></button>
            {{-- <script>
              $('#btnBatalTambahKategori').on('click',()=>{
                // 
                $('#addKat').attr('disabled');
              });
            </script> --}}
            <button type="button" id="tambahKategoriBtn" name="" class="btn blue darken-2" data-position="bottom" data-tooltip="Simpan"><i class="material-icons left">check</i>SIMPAN</button>
          {{-- </div> --}}
        </div>
    {{-- </form> --}}
  </div>
</main>
@endsection
 
@section('js')
<script src="/asset/prev/prev.js" charset="utf-8"></script>
<script src="/js/produk.js"></script>

<script type="text/javascript">
  @foreach($isiPro as $pro)
    $.uploadPreview({
        input_field: '#imgProFile{{$pro->id}}',
        preview_box: '#imgProEditPrev{{$pro->id}}',
        success_callback: function () {
            $('#imgProEditPrev{{$pro->id}}').show();
            $('#imgProReal{{$pro->id}}').hide();
        }
    });
  @endforeach

  @foreach($isiPro as $pro)
    $('#hapusPro{{$pro->id}}').click(function () {
        swal({
            title: 'Peringatan !',
            text: 'Apakah anda ingin menghapus {{$pro->nama}} .?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                direct('/produk/{{$pro->id}}/delete');
            }
        });
    });

    @endforeach

  @if(session() -> has('berhasilMasuk'))

    swal({
        title: 'Berhasil !',
        type: 'success',
        text: 'Selamat datang kembali di toko anda !'
    });

    @endif

    @if(session() -> has('berhasilTambahProduk'))

    swal({
        title: 'Berhasil !',
        type: 'success',
        text: 'Berhasil menambah produk !'
    }).then((result) => {
        if (result.value) {
            var posProduk = $('#produk{{session()->get('
                idPro ')}}').position();

            $('html, body').animate({
                scrollTop: posProduk.top
            }, 'fast', function () {
                $('#produk{{session()->get('
                    idPro ')}}').addClass('flash');
            });
        }
    });

    @endif

    @if($errors -> has('imgPro'))

    swal({
        title: 'Gagal !',
        text: 'Gagal menambahkan produk, karena ukuran foto melebihi 2MB, silahkan ulangi lagi',
        type: 'error'
    });

    @endif

    @if($errors -> has('harga'))

    swal({
        title: 'Gagal !',
        text: 'Harga beli lebih dari harga jual !',
        type: 'error'
    });

    @endif

    @if(session() -> has('gagalTambahProduk'))

    swal({
        title: 'Gagal !',
        text: 'Gagal menambah produk, karena kode produk dengan kategori yang di gunakan telah ada, silahkan coba lagi',
        type: 'error'
    });

    @endif

    @if(session() -> has('gagalUpdateProduk'))

    swal({
        title: 'Gagal !',
        text: 'Gagal mengupdate produk, karena kode produk dengan kategori yang di gunakan telah ada, silahkan coba lagi',
        type: 'error'
    });

    @endif

    @if(session() -> has('berhasilHapusProduk'))

    swal({
        title: 'Berhasil !',
        text: 'Berhasil menghapus produk',
        type: 'success'
    });

    @endif

    @if(session() -> has('berhasilUpdateProduk'))

    swal({
        title: 'Berhasil !',
        text: 'Berhasil mengupdate produk',
        type: 'success'
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