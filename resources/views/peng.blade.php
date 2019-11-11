@extends('lay.mas')


@section('title')PENGATURAN || MANTO @endsection

@section('css')
  <link rel="stylesheet" href="/asset/crop/c.css">
  <style media="screen">
    @keyframes identifier {

    }
  </style>
@endsection

@section('body')
<input type="hidden" name="" id="_idUser" value="{{session()->get('idUser')}}">
<input type="hidden" name="_token" id="_tokenLaravel" value="{{csrf_token()}}">



  <ul class="sidenav sidenav-fixed theming-sideBar trans" id="sidenav">
    <li>
      <div class="navbar-fixed">
        <nav class="theming trans @if ($setting->tema == 1)
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
    <li>
      <a class="waves-effect waves-dark" href="{{route('riwayat')}}"><i class="material-icons left">history</i>Riwayat</a>
    </li>
    <li>
      <a class="waves-effect waves-dark" href="{{route('karyawan')}}"><i class="material-icons left">people</i>Karyawan</a>
    </li>
    <li class="active">
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
  </ul>

  <!--  -->

  <header>
    <div class="navbar-fixed">
      <nav class="theming trans @if ($setting->tema == 1)
            blue darken-3
            @else
            grey darken-4
        @endif">
        <div class="navbar-wrapper">
          <a href="#" class="sidenav-trigger" data-target="sidenav"><i class="material-icons">menu_vert</i></a>
          <a href="#" class="brand-logo">PENGATURAN</a>
        </div>
      </nav>
    </div>
  </header>

  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col l12 m12 s12">
          <ul class="collapsible">
            <li>
              <div class="collapsible-header"><i class="material-icons left">airplay</i>Pengaturan Tampilan</div>
              <div class="collapsible-body">
                {{-- TEMAAAA+++++++++++++++++++++++++++++++ --}}
                <hr>
                <div class="row">
                  <div class="col l12 m12 s12">
                    <span class="bold">Mode Malam</span>
                  </div>
                  <div class="col l12 m12 s12" style="margin-top:20px">
                    <div class="switch">
                      <label>
                        Mati
                        <input type="checkbox" id="temaChanger" @if ($setting->tema == 0)checked @endif>
                        <span class="lever"></span>
                        Hidup
                      </label>
                    </div>
                  </div>
                </div>
                {{-- FOTO PROFIL MAANMANMNAMMNMNAMGNMAGNMAGNAMGNGM --}}
                <hr>
                <div class="row">
                  <div class="col l12 m12 s12">
                    <span class="bold">Foto Profil</span> <button type="button" name="" class="btn right modal-trigger editImgProfilTrigger orange darken-2" data-target="modalImgProfil"><i class="material-icons">create</i></button>
                  </div>
                  <div class="col l12 m12 s12">
                    <img src="{{$setting->imgProfil}}" alt="" width="200" class="materialboxed">
                  </div>
                </div>

                <!-- FOTO SAMPULMAMAMAMAMAHNANBMAAHAHAHANAh -->
                <hr>
                <div class="row">
                  <div class="col l12 m12 s12">
                    <span class="bold">Foto Sampul</span> <button type="button" name="" class="btn right modal-trigger editImgSampulTrigger orange darken-2" data-target="modalImgSampul"><i class="material-icons">create</i></button>
                  </div>
                  <div class="col l12 m12 s12">
                    <img src="{{$setting->imgSampul}}" alt="" width="300" class="materialboxed">
                  </div>
                </div>

                <!--  -->
              </div>
            </li>
            <!--  -->
            <li class="
              @if (session()->has('passwordSalah'))
                active
              @endif
            ">
              <div class="collapsible-header">
                <i class="material-icons left">person</i> Pengaturan Akun
              </div>
              <div class="collapsible-body">
                <hr>
                <div class="row">
                  <div class="col l12 m12 s12">
                    <span class="bold">Nama</span> <button type="button" name="" class="btn right modal-trigger orange darken-2" data-target="modalNama"><i class="material-icons">create</i></button>
                  </div>
                  <div class="col l12 m12 s12">
                    <p>{{$user->nama}}</p>
                  </div>
                </div>

                {{--  --}}
                <hr>
                <div class="row">
                  <div class="col l12 m12 s12">
                    <span class="bold">Nama Toko</span> <button type="button" name="" class="btn right modal-trigger orange darken-2" data-target="modalNamaToko"><i class="material-icons">create</i></button>
                  </div>
                  <div class="col l12 m12 s12">
                    <p>{{$user->namaToko}}</p>
                  </div>
                </div>

                {{--  --}}
                <hr>
                <div class="row">
                  <div class="col l12 m12 s12">
                    <span class="bold">Email</span> <button type="button" name="" class="btn right modal-trigger orange darken-2" data-target="modalEmail" id="modalEmail-trigger"><i class="material-icons">create</i></button>
                  </div>
                  <div class="col l12 m12 s12">
                    <p>{{$user->email}}</p>
                  </div>
                </div>

                <!--  -->
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- AKHIR CONTENTER -->
      <!-- modal imgPROFIL -->
                <div class="modal" id="modalImgProfil">
                  <form action="{{route('uploadImgProfil')}}" enctype="multipart/form-data" method="post">
                    <div class="modal-content">
                      <h4>EDIT FOTO PROFIL</h4>
                      <div class="row">
                        <div class="col l12 m12 s12 input-field file-field">
                          <div class="btn">
                            <span>Pilih Gambar</span>
                            <input type="file" id="inputImgProfil" accept="image/*" name="imgProfil" required>
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" id="pathImgProfil">
                          </div>
                          <span class="helper-text">Usahakan pilih gambar berskala 1:1</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col l12 m12 s12">
                          <div class="thumImg" id="imgProfilPref" style="display:none"></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn red darken-2 modal-close" type="button">BATAL</button>
                      <input type="button" name="" id="submitImgProfil"  class="btn blue darken-2" value="SIMPAN">
                    </div>
                    {{ csrf_field() }}
                  </form>
                </div>
                {{-- MODAL IMG SAMPUL +++++++++++++++++++++++++ --}}
                <div class="modal" id="modalImgSampul">
                  <form class="" action="{{route('uploadImgSampul')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                      <h4>EDIT FOTO SAMPUL</h4>
                      <div class="row">
                        <div class="input-field file-field col l12 m12 s12">
                          <div class="btn">
                            <span>Pilih Gambar</span>
                            <input type="file" id="inputImgSampul" accept="image/*" name="imgSampul" required>
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" id="pathImgSampul">
                          </div>
                          <span class="helper-text">Usahakan pilih gambar ukuran 300 x 170 px</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col l12 m12 s12">
                          <div class="thumImg" id="imgSampulPref" style="display:none"></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="button" name="" class="btn red darken-2 modal-close" value="BATAL" >
                      <input type="button" id="submitImgSampul" name="" class="btn blue darken-2" value="SIMPAN" >
                    </div>
                    {{ csrf_field() }}
                  </form>
                </div>
                {{-- MODAL NAMAMAMAMANMANAMNMANMANMANMANMANAMANAMANAMANAMANAM --}}
                  <div class="modal modal-fixed-footer" id="modalNama">
                    <form action="{{route('updateNama')}}" method="post">
                      <div class="modal-content">
                        <h4>EDIT NAMA</h4>
                        <div class="row">
                          <div class="col l12 m12 s12 input-field">
                            <label for="nama">Masukkan nama</label>
                            <input type="text" name="nama" id="nama" value="{{$user->nama}}" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="button" class="btn red darken-2 modal-close" value="BATAL" name="" >
                        <input type="submit" class="btn blue darken-2" value="SIMPAN" name="" >
                      </div>
                      {{ csrf_field() }}
                    </form>
                  </div>
                  {{-- MODAL NAMAMAMAMANMANAMNMANMANMANMANMANAMANAMANAMANAMANAM TOKOKOKOKOKOKOKOKOK --}}
                  <div class="modal modal-fixed-footer" id="modalNamaToko">
                    <form action="{{route('updateNamaToko')}}" method="post">
                      <div class="modal-content">
                        <h4>EDIT NAMA TOKO</h4>
                        <div class="row">
                          <div class="col l12 m12 s12 input-field">
                            <label for="namToko">Masukkan nama toko</label>
                            <input type="text" name="namaToko" id="namToko" value="{{$user->namaToko}}" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="button" class="btn red darken-2 modal-close" value="BATAL" name="" >
                        <input type="submit" class="btn blue darken-2" value="SIMPAN" name="" >
                      </div>
                      {{ csrf_field() }}
                    </form>
                  </div>
                  <!-- MODAL EMAILL YAA +++++++++++++++++++ -->
                <div class="modal modal-fixed-footer" id="modalEmail">
                  <form class="" action="{{route('updateEmail')}}" method="post">
                    <div class="modal-content">
                      <h4>EDIT EMAIL</h4>
                      <div class="row">
                        <div class="input-field col l12 m12 s12">
                          <label for="email">Masukkan Email</label>
                          <input type="email" name="email" id="email" value="{{$user->email}}" required>
                        </div>
                        <div class="input-field col l12 m12 s12">
                          <label for="password">Masukkan password untuk konfirmasi</label>
                          <input type="password" name="password" id="password" value="" required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="button" class="btn red darken-2 modal-close" value="BATAL" name="" >
                      <input type="submit" class="btn blue darken-2" value="SIMPAN" name="" >
                    </div>
                    <input type="text" name="changerUpdateEmail" id="changerUpdateEmail" value="0">
                    {{ csrf_field() }}
                  </form>
                </div>
    </div>
  </main>
@endsection

@section('js')
<script src="/asset/prev/prev.js" charset="utf-8"></script>
<script src="/asset/crop/c.js"></script>
<script src="/asset/crop/exif.js"></script>
<script src="/js/pengaturan.js"></script>
<script type="text/javascript">

      @if($setting->tema == '0')
        $('.theming-body').addClass('grey darken-4');
        $('.collapsible-body').addClass('white-text');
        // $('.theming-sideBar').addClass('grey darken-2');
        // $('.theming-text').addClass('orange-text text-darken-2');
      @endif

    @if (session()->has('berhasilUpdateImgProfil'))

      swal({
        title:'Berhasil !',
        text:'Behasil merubah foto profil ',
        type:'success'
      });

    @endif

    @if (session()->has('berhasilUpdateImgSampul'))

      swal({
        title:'Berhasil !',
        text:'Behasil merubah foto sampul ',
        type:'success'
      });

    @endif

    @if ($errors->has('imgProfil'))

      swal({
        title:'Gagal !',
        text:'Gambar yang anda pilih melebihi batas ukuran, silahkan pilih gambar yang lain dengan ukuran dibawah 2MB',
        type:'error'
      });

    @endif

    @if ($errors->has('imgSampul'))

      swal({
        title:'Gagal !',
        text:'Gambar yang anda pilih melebihi batas ukuran, silahkan pilih gambar yang lain dengan ukuran dibawah 2MB',
        type:'error'
      });

    @endif

    //

    @if (session()->has('berhasilUpdateNama'))

      swal({
        title:'Berhasil !',
        text:'Behasil merubah nama anda ',
        type:'success'
      });

    @endif

    @if (session()->has('berhasilUpdateNamaToko'))

      swal({
        title:'Berhasil !',
        text:'Behasil merubah nama toko anda ',
        type:'success'
      });

    @endif

    @if (session()->has('passwordSalah'))

      // $('#modalEmail-trigger').click();

      swal({
        title:'Gagal !',
        text:'Gagal mengupdate email, password yang anda masukkan salah, silahkan coba lagi !',
        type:'error'
      });

    @endif

    @if (session()->has('emailSudahAda'))

      // $('#modalEmail-trigger').click();

      swal({
        title:'Gagal !',
        text:'Gagal mengupdate email, email sudah tersedia, silahkan coba lagi !',
        type:'error'
      });

    @endif

    @if (session()->has('berhasilUpdateEmail'))

      swal({
        title:'Berhasil !',
        text:'Berhasil mengupdate email, silahkan login kembali untuk melanjutkan !',
        type:'success'
      }).then((result)=>{
        if (result.value) {
          direct('{{route('keluar')}}');
        }
      });

    @endif
  </script>
@endsection
