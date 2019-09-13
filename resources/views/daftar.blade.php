@extends('lay.mas')


@section('title')
  Selamat Datang
@endsection

@section('css')
  <style media="screen">
    body{
      overflow: hidden;
    }
    .formMasuk{
      width: 600px;
      background-color: red;
      padding: 30px;
      border-radius: 10px;
    }
    .isi{

      width: 100%;
      height: 30%;

      position: absolute;
      z-index: -10;

      top: 0;
      left: 0;


    }

      /* label color */
    .input-field label {
      color: #fff;
    }
    /* label focus color */
    .input-field input[type=text]:focus + label {
      color: #000;
    }
    /* label underline focus color */
    .input-field input[type=text]:focus {
      border-bottom: 1px solid #fff;
      box-shadow: 0 1px 0 0 #fff;
    }
    /* icon prefix focus color */
    .input-field .prefix.active {
      color: #000;
    }
  </style>
@endsection

@section('body')

  <div class="vh disFlex white-text">
    <div class="isi hide-on-small-only animated fadeInDown blue darken-1"></div>
    <div class="formMasuk z-depth-3 blue darken-3 animated fadeInUp">
      <div class="row">
        <div class="col l12 m12 s12 center-align">
          <h3>SELAMAT DATANG</h3>
          <p>Silahkan mendaftar untuk melanjutkan</p>
        </div>
      </div>

      <form action="{{route('postDaftar')}}" class="row" method="post">
        <div class="col l12 m12 s12 input-field">
          <i class="material-icons prefix">account_circle</i>
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" value="{{old('nama')}}" required>
        </div>

        <div class="col l12 m12 s12 input-field">
          <i class="material-icons prefix">email</i>
          <label for="email">Email</label>
          <input type="email" name="email" id="email" value="{{old('email')}}" required>
        </div>

        <div class="col l6 m6 s12 input-field">
          <i class="material-icons prefix">vpn_key</i>
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required min="8">
        </div>

        <div class="col l6 m6 s12 input-field">
          <i class="material-icons prefix">https</i>
          <label for="passwordKon">Ketik ulang password</label>
          <input type="password" name="passwordKon" id="passwordKon" required>
        </div>

        <div class="col l6 m6 s6 left-align">
          <a href="{{route('masuk')}}" class="white-text waves-effect waves-dark">Sudah punya akun .?</a>
        </div>

        <div class="col l6 m6 s6 right-align ">
          <button class="ui button animated fade teal" type="submit">
            <div class="hidden content">
              <i class="paper plane icon"></i>
            </div>
            <div class="visible content">
              DAFTAR
            </div>
          </button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
  </div>

@endsection

@section('js')

  <script type="text/javascript">
    @if ($errors->has('password'))

      swal({
        text:'Password konfirmasi tidak sama dan Minimal 8 karakter, silahkan ulangi sekali lagi',
        type:'error',
        title:'Gagal !'
      });

    @endif

    @if (session()->has('emailSudahAda'))

      swal({
        text:'Email sudah terdaftar, silahkan masuk !',
        type:'error',
        title:'Gagal !'
      });

    @endif
  </script>
@endsection
