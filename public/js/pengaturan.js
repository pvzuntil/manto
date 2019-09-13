$(function () {

     $('#email').on('change', ()=>{
          $('#changerUpdateEmail').val(1);
     });

     // $.uploadPreview({
     //      input_field: "#inputImgProfil",   // Default: .image-upload
     //      preview_box: "#imgProfilPref",  // Default: .image-preview
     //      // label_field: "#image-label",    // Default: .image-label
     // });
          
     // $.uploadPreview({
     //      input_field: "#inputImgSampul",   // Default: .image-upload
     //      preview_box: "#imgSampulPref",  // Default: .image-preview
     //      // label_field: "#image-label",    // Default: .image-label
     // });


     // NEW FEATURE CROPPINGG +=++++++++++++++++++++++++++++++++++
     // IMG PROFIL

     
     
     $cropper = $('#imgProfilPref').croppie({
          enableExif:true,
          viewport:{
               width:380,
               height:380,
               type:'circle'
          },
          boundary:{
               width:400,
               height:400
          },
          showZoomer:true
     });
     $('#inputImgProfil').on('change', function(){
          $('#imgProfilPref').show();
          var posCropper = $('#imgProfilPref').position().top;

          $('#modalImgProfil').animate({
               scrollTop: posCropper - 20
          }, 'slow');
          
          var r = new FileReader();
          r.onload = function (event) {
               $cropper.croppie('bind', {
                    url: event.target.result
               });
          }
          r.readAsDataURL(this.files[0]);
     });

     $('#submitImgProfil').on('click', ()=>{
          var _idUser = $('#_idUser').val();
          if ($('#pathImgProfil').val() == '') {
               swal({
                    title: 'Gagal !',
                    text: 'Silahkan pilih gambar dulu',
                    type: 'error'
               });
          } else {

               $cropper.croppie('result',{
                    type:'canvas',
                    size:'viewport',
                    format:'png'
               }).then(function(hasilCrop){
                    $.ajax({
                         url:'/php/imgProfil.php',
                         // url:'/cropImgProfil',
                         method:'POST',
                         data:{
                              img:hasilCrop,
                              idUser:_idUser
                         },
                         success:function(){
                              swal({
                                   title:'Berhasil !',
                                   text:'Berhasil mengubah foto profil !',
                                   type:'success'
                              }).then(()=>{
                                   location.reload();
                              });
                              
                         }
                    });
               });
          }

          
     });

     // IMG  SAMPULLLLL
     $cropper2 = $('#imgSampulPref').croppie({
          enableExif: true,
          viewport: {
               width: 300,
               height: 170
               // type: 'circle'
          },
          boundary: {
               width: 400,
               height: 400
          },
          showZoomer: true
     });
     $('#inputImgSampul').on('change', function () {
          $('#imgSampulPref').show();
          var posCropper = $('#imgSampulPref').position().top;

          $('#modalImgSampul').animate({
               scrollTop: posCropper - 20
          }, 'slow');

          var r = new FileReader();
          r.onload = function (event) {
               $cropper2.croppie('bind', {
                    url: event.target.result
               });
          }
          r.readAsDataURL(this.files[0]);
     });

     $('#submitImgSampul').on('click', () => {
          var _idUser = $('#_idUser').val();

          if ($('#pathImgSampul').val() == '') {
               swal({
                    title: 'Gagal !',
                    text: 'Silahkan pilih gambar dulu',
                    type: 'error'
               });
          }else{

               $cropper2.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                    format: 'png'
               }).then(function (hasilCrop) {
                    $.ajax({
                         url: '/php/imgSampul.php',
                         // url:'/cropImgSampul',
                         method: 'POST',
                         data: {
                              img: hasilCrop,
                              idUser: _idUser
                         },
                         success: function () {
                              swal({
                                   title: 'Berhasil !',
                                   text: 'Berhasil mengubah foto sampul !',
                                   type: 'success'
                              }).then(() => {
                                   location.reload();
                              });
     
                         }
                    });
               });
          }


     });

     // END NEW FEATURE ======================================

     
     $('#sidenav').sidenav();
     $('.materialboxed').materialbox();
     $('.fixed-action-btn').floatingActionButton();
     $('.materialize-textarea').characterCounter();
     $('.tooltiped').tooltip();
     $('.modal').modal();
     $('.collapsible').collapsible();


     $('#temaChanger').on('change', function () {

          $.ajax({
               url: '/tema',
               method: 'GET',
               success: function (data) {
                    if (data == '1') {
                         // HEADERRRR
                         $('.theming').addClass('blue darken-3');
                         $('.theming').removeClass('grey darken-4');
                         // BODYYY
                         $('.theming-body').removeClass('grey darken-4');
                         // TEXT
                         // $('.theming-text').removeClass('orange-text text-darken-4');
                         $('.collapsible-body').removeClass('white-text');
                         // SIDE BAR
                         // $('.theming-sideBar').removeClass('grey darken-2');
                    } else if (data == '0') {
                         // HEADER
                         $('.theming').addClass('grey darken-4');
                         $('.theming').removeClass('blue darken-3');
                         // BODYY
                         $('.theming-body').addClass('grey darken-4');
                         // TEXTTTTTT
                         // $('.theming-text').addClass('orange-text text-darken-4');
                         $('.collapsible-body').addClass('white-text');
                         // SIDE BAR
                         // $('.theming-sideBar').addClass('grey darken-2');
                    }
               }
          });

     });


     $('.editImgProfilTrigger').click(function () {
          $('#inputImgProfil').click();
     });
     
     $('.editImgSampulTrigger').click(function () {
          $('#inputImgSampul').click();
     });
});


