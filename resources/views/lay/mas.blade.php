<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>@yield('title')</title>

  <script src="/asset/jquery/jquery.js" charset="utf-8"></script>


  <link rel="stylesheet" href="/asset/mat/mat.min.css">
  <link rel="stylesheet" href="/asset/sw/sw.css">
  <link rel="stylesheet" href="/asset/anim/anim.css">
  <link rel="stylesheet" href="/asset/main.css">
  {{-- <link rel="stylesheet" href="/css/app.css"> --}}
  <link rel="stylesheet" href="/asset/sem/kom/button.min.css">
  <link rel="stylesheet" href="/asset/sem/kom/icon.min.css">
  {{--  --}}
  <link rel="shortcut icon" href="/ufa.png">

  <style>
    header, footer {
      padding-left: 300px;
    }
    .paddingMain{
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
      .paddingMain{
        padding-left: 0;
      }
    }
    

    .navbar-wrapper{
      padding: 0px 20px;
    }
  </style>

  @yield('css')
</head>
<body class="theming-body trans theming-text">
  <div class="vh disFlex load grey darken-4">
    <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
  </div>

  @yield('body')


  <script src="/asset/mat/mat.min.js" charset="utf-8"></script>
  {{-- <script src="/asset/sem/sem.min.js" charset="utf-8"></script> --}}
  <script src="/asset/sw/sw.js" charset="utf-8"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.load').fadeOut('slow');
      $('main').addClass('paddingMain');
    });

    function direct(url) {
      window.location.href = url;
    }
    //
    $('#btnKeluar').click(function () {
      swal({
        title:'Peringatan !',
        text:'Apakan anda yakin ingin keluar .?',
        type:'info',
        showCancelButton:true,
        cancelButtonText:'Batal',
        confirmButtonText:'Ya'
      }).then((result)=>{
        if (result.value) {
          direct('{{route('keluar')}}')
        }
      });
    });


    // $('.sidenav').hide();/
  </script>
  @yield('js')
</body>
</html>
