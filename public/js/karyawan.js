$(() => {
     var loading = '<tr><td colspan="5" class="center-align"><div class="preloader-wrapper small active"><div class="spinner-layer spinner-blue"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-red"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-yellow"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-green"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></td></tr>';
     var _token = $('#_tokenLaravel').val();
     var passIdUser = $('#_userPassword').val();


     $('#sidenav').sidenav();
     $('.tooltiped').tooltip();
     $('.materialboxed').materialbox();
     $('.modal').modal();
     $('.fixed-action-btn').floatingActionButton();
     $('select').formSelect();

     $('.tambahTrigger').click(function () {
          $('#fieldTambahKat').animate({
               height: 'toggle'
          });
          $('.tambahTrigger').addClass('scale-out');
          $('.tambahTrigger').removeClass('scale-in');
          $('#nama').focus();
     });

     $('.batalTrigger').click(function () {
          $('#fieldTambahKat').animate({
               height: 'toggle'
          });
          $('.tambahTrigger').removeClass('scale-out');
          $('.tambahTrigger').addClass('scale-in');
     });

     // 
     function loadKaryawan() {
          $.ajax({
               url: '/loadKaryawan',
               method: 'GET',
               beforeSend: function () {
                    $('#fieldKar').html(loading);
               },
               success: function (data) {
                    $('#fieldKar').empty();
                    if (data == 0) {
                         $('#fieldKar').html('<tr><td colspan="4" class="center">Tidak ada data karyawan</td></tr>');
                    } else {
                         $.each(data, function (i, d) {
                              if (d.level == 'kasir') {
                                   $('#fieldKar').append('<tr><td>' + d.nama + '</td><td>' + d.email + '</td><td>Kasir</td><td><button title="Tampilkan Password" class="btn modal-trigger blue darken-2" id="' + d.id + '" role-btn="btnShowPassword" data-target="modalShowPassword" style="margin-right:10px"><i class="material-icons">visibility</i></button><button title="Edit" class="btn modal-trigger orange darken-2" id="' + d.id + '" role-btn="btnEdit" data-target="modalEditKaryawan" style="margin-right:10px"><i class="material-icons">create</i></button><button title="Hapus" class="btn red darken-2" id="' + d.id + '" role-btn="btnHapusKaryawan" data-nama-karyawan="' + d.nama + '"><i class="material-icons">delete</i></button></td></tr>');

                              } else if (d.level == 'inv') {
                                   $('#fieldKar').append('<tr><td>' + d.nama + '</td><td>' + d.email + '</td><td>Inventor</td><td><button title="Tampilkan Password" class="btn modal-trigger blue darken-2" id="' + d.id + '" role-btn="btnShowPassword" data-target="modalShowPassword" style="margin-right:10px"><i class="material-icons">visibility</i></button><button title="Edit" class="btn modal-trigger orange darken-2" id="' + d.id + '" role-btn="btnEdit" data-target="modalEditKaryawan" style="margin-right:10px"><i class="material-icons">create</i></button><button title="Hapus" class="btn red darken-2" id="' + d.id + '" role-btn="btnHapusKaryawan" data-nama-karyawan="' + d.nama + '"><i class="material-icons">delete</i></button></td></tr>');
                              }
                         });
                    }
               }
          });
     };

     function loadPasswordKaryawan() {
          var key = $('#passwordUser').val();
          var idKar = $('#passwordUser').attr('idKar');

          $.ajax({
               url: '/cekPassword',
               method: 'POST',
               data: {
                    _token: _token,
                    key: key,
                    passIdUser: passIdUser,
                    id: idKar
               },
               beforeSend: function () {
                    $('#helperPasswordUser').html('Loading . . . ');
               },
               success: function (data) {
                    if (data != 0) {
                         $('#helperPasswordUser').html('*Masukkan password anda');
                         swal({
                              title: 'Password ' + data.nama + '',
                              text: '' + data.password + '',
                              type: 'success'
                         });
                    } else {
                         $('#helperPasswordUser').html('Password anda salah !');
                    }
               }
          });
     }


     // CALLLLLLL
     loadKaryawan();


     // 
     $('#submitKaryawan').on('click', () => {
          var nama = $('#nama').val();
          var level = $('#level').val();
          var email = $('#email').val();
          var password = $('#password').val();
          var passwordKon = $('#passwordKon').val();

          // console.log(level);

          if (nama == '' || level == null || email == '') {
               swal({
                    title: 'Gagal !',
                    text: 'Semua Bidang Wajib diisi !',
                    type: 'error'
               });
          } else {

               if (password.length < 8) {
                    swal({
                         title: 'Gagal !',
                         text: 'Password Minimal 8 Karakter',
                         type: 'error'
                    });
               } else {
                    if (password == passwordKon) {
                         // console.log('sama'); SUCCCCEEELLLLLLLSSS

                         if (email == $('#_userEmail').val()) {
                              swal({
                                   title: 'Gagal !',
                                   text: 'Email Sudah Terdaftar, Silahkan coba lagi',
                                   type: 'error'
                              });
                         } else {
                              $.ajax({
                                   url: '/karyawan',
                                   method: 'POST',
                                   data: {
                                        nama: nama,
                                        level: level,
                                        email: email,
                                        password: password,
                                        _token: _token
                                   },
                                   success: function (data) {
                                        if (data == 'emailSudahAda') {
                                             swal({
                                                  title: 'Gagal !',
                                                  text: 'Email Sudah Terdaftar, Silahkan coba lagi',
                                                  type: 'error'
                                             });
                                        } else {
                                             swal({
                                                  text: 'Karyawan berhasil ditambahkan !',
                                                  title: 'Berhasil !',
                                                  type: 'success'
                                             });
                                             $('#btnBatal').click();

                                             $('#nama').val('');
                                             $('#level').val(null);
                                             $('#email').val('');
                                             $('#password').val('');
                                             $('#passwordKon').val('');

                                             loadKaryawan();

                                        }
                                   }
                              });
                         }
                    } else {
                         swal({
                              title: 'Gagal !',
                              text: 'Password Konfirmasi Harus Sama, silahkan coba lagi',
                              type: 'error'
                         });
                    }

               }
          }


     });
     // SHOW PASSWORD
     $(document).on('click', 'button', function () {

          if ($(this).attr('role-btn') == 'btnShowPassword') {
               var idKar = $(this).attr('id');
               $.ajax({
                    url: '/loadNama',
                    method: 'POST',
                    data: {
                         id: idKar,
                         _token: _token
                    },
                    beforeSend: function () {
                         $('#headerShowPassword').html(loading);
                    },
                    success: function (data) {
                         $('#headerShowPassword').html('Password dari ' + data.nama);
                         $('#passwordUser').attr('idKar', data.id);
                    }
               });
          } else if ($(this).attr('role-btn') == 'btnHapusKaryawan') {
               var idKar = $(this).attr('id');

               swal({
                    title: 'Peringatan !',
                    text: 'Apakah anda ingin menghapus karyawan ' + $(this).attr('data-nama-karyawan') + ' ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
               }).then((result) => {
                    if (result.value) {
                         $.ajax({
                              url: '/karyawan/delete',
                              method: 'POST',
                              data: {
                                   _token: _token,
                                   id: idKar
                              },
                              success: function (data) {
                                   swal({
                                        title: 'Berhasil !',
                                        text: 'Berhasil menghapus karyawan',
                                        type: 'success'
                                   });
                                   loadKaryawan();
                              }
                         });
                    }
               });
          } else if ($(this).attr('role-btn') == 'btnEdit') {

               var idKar = $(this).attr('id');

               $.ajax({
                    url: '/getDataKaryawan/' + idKar + '',
                    method: 'GET',
                    data: {
                         idKar: idKar
                    },
                    beforeSend: function () {
                         $('#headerEditKaryawan').html(loading);
                         $('#submitEditKaryawan').addClass('disabled');
                         // 
                         $('#editPassword').val(null);
                         $('#editPasswordKon').val(null);
                    },
                    success: function (data) {
                         // 
                         $('#submitEditKaryawan').toggleClass('disabled');
                         $('#changerEmail').val(0);
                         $('#changerPassword').val(0);
                         // 
                         $('#headerEditKaryawan').html('Edit ' + data.nama + '');
                         // 
                         $('#editNama').val(data.nama);
                         $('#editEmail').val(data.email);
                         $('#idKar').val(data.id);
                         if (data.level == 'inv') {
                              $('#editLevel').val('inv');
                              // if(!$('#optionEditInv').attr('selected')){
                              //   $('#optionEditInv').attr('selected','');
                              // }
                              // if($('#optionEditKasir').attr('selected')){
                              //   $('#optionEditKasir').removeAttr('selected');
                              // }
                         } else if (data.level == 'kasir') {
                              $('#editLevel').val('kasir');
                              // if($('#optionEditInv').attr('selected')){
                              //   $('#optionEditInv').removeAttr('selected');
                              // }
                              // if(!$('#optionEditKasir').attr('selected')){
                              //   $('#optionEditKasir').attr('selected','');
                              // }
                         }
                         // 
                    }
               });
          }
     });

     $('#submitEditKaryawan').on('click', () => {

          var editNama = $('#editNama').val();
          var editEmail = $('#editEmail').val();
          // var editPassword = $('#editPassword').val();
          // var editPasswordKon = $('#editPasswordKon').val();
          var editLevel = $('#editLevel').val();
          var changerEmail = $('#changerEmail').val();
          var idKar = $('#idKar').val();

          if (editNama == '' || editLevel == null || editEmail == '') {
               swal({
                    title: 'Gagal !',
                    text: 'Tolong isi semua bidang !',
                    type: 'error'
               });

          } else {

               $.ajax({
                    url: '/karyawan/update',
                    method: 'POST',
                    data: {
                         idKar: idKar,
                         nama: editNama,
                         level: editLevel,
                         email: editEmail,
                         changerEmail: changerEmail,
                         _token: _token
                    },
                    success: function (data) {
                         if (data == 'emailSudahAda') {
                              swal({
                                   title: 'Gagal !',
                                   text: 'Email sudah ada, siahkan masukkan yang lainnya !',
                                   type: 'error'
                              });
                         } else {

                              swal({
                                   title: 'Berhasil !',
                                   text: 'Berhasil mengubah karyawan !',
                                   type: 'success'
                              });

                              $('#btnBatalEditKaryawan').click();
                              loadKaryawan();
                         }
                    }
               });
          }
     });

     $('#passwordUser').on('keyup', () => {
          loadPasswordKaryawan();
     });

     $('#lihatBtn').on('click', () => {
          loadPasswordKaryawan();
     });

     $('#editEmail').on('keyup', () => {
          $('#changerEmail').val(1);
     });
});