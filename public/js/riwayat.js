$(function () {
     var _namaToko = $('#_namaToko').val();

     $('#sidenav').sidenav();
     $('.materialboxed').materialbox();
     $('.fixed-action-btn').floatingActionButton();
     $('.materialize-textarea').characterCounter();
     $('.tooltiped').tooltip();
     $('.modal').modal();
     $('.collapsible').collapsible();

     $('.page-link').addClass('waves-effect');

     $('.page-link').first().html('<i class="material-icons">chevron_left</i>');
     $('.page-link').last().html('<i class="material-icons">chevron_right</i>');

     // 
     var loading = '<tr><td colspan="4" class="center-align"><div class="preloader-wrapper small active"><div class="spinner-layer spinner-blue"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-red"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-yellow"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div><div class="spinner-layer spinner-green"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></td></tr>';

     $(document).on('click', 'li', function () {
          var riwayatLoaded = $(this).attr('riwayat-loaded');

          if (riwayatLoaded == '0') {
               if ($(this).attr('data-type') == 'kodePembelian') {
                    var _token = $('#_tokenLaravel').val();
                    var kodePembelian = $(this).attr('riwayat-kodePembelian');
                    var idRiwayat = $(this).attr('riwayat-id');

                    $.ajax({
                         url: '/riwayatPembelian',
                         method: 'POST',
                         data: {
                              _token: _token,
                              kodePembelian: kodePembelian,
                              idRiwayat: idRiwayat
                         },
                         beforeSend: function () {
                              $('#' + idRiwayat + '').html(loading);
                         },
                         success: function (data) {
                              setTimeout(function () {
                                   $('#' + idRiwayat + '').html(data);
                                   $('#riwayat' + idRiwayat + '').attr('riwayat-loaded', '1');
                              }, 1000);
                         }
                    });
               }
          }
     });

     $('#btnStat').on('click', function () {
          $('#rowStat').animate({
               height: 'toggle'
          });
     });

     if ($('#rowStat').attr('loaded') == '0') {

          $.ajax({
               url: '/chart',
               method: 'GET',
               success: function (data) {
                    var tanggalan = [];
                    var banyakPembelianPadaTanggal = [];
                    // var banyakPemasukanPadaTanggal = [];
                    $.each(data, function (i, d) {
                         tanggalan.push(d.tanggal);
                         banyakPembelianPadaTanggal.push(d.banyakTanggal);
                    });
                    var cc = document.getElementById('chartPemasukan').getContext('2d');

                    cc = new Chart(cc, {
                         type: 'line',
                         data: {
                              labels: tanggalan,
                              datasets: [{
                                   label: 'Transaksi Sukses',
                                   data: banyakPembelianPadaTanggal,
                                   backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                   borderColor: 'rgba(54, 162, 235, 1)',
                                   borderWidth: 2,
                                   fill: true
                              }
                              ]
                         },
                         options: {
                              responsive: true,
                              scales: {
                                   xAxes: [{
                                        display: true,
                                        scaleLabel: {
                                             display: true,
                                             labelString: 'Tanggal'
                                        }
                                   }],
                                   yAxes: [{
                                        display: true,
                                        scaleLabel: {
                                             display: true,
                                             labelString: 'Banyak Pembeli'
                                        }
                                   }]
                              },
                              tooltips: {
                                   mode: 'index',
                                   intersect: false,
                              },
                              hover: {
                                   mode: 'nearest',
                                   intersect: true
                              },
                              title: {
                                   display: true,
                                   text: 'PERKEMBANGAN TOKO ' + _namaToko
                              },
                         }
                    });
               }
          });
          // 
          $.ajax({
               url: '/chart',
               method: 'GET',
               success: function (data) {
                    var tanggalan = [];
                    // var banyakPembelianPadaTanggal = [];
                    var banyakPemasukanPadaTanggal = [];
                    $.each(data, function (i, d) {
                         tanggalan.push(d.tanggal);
                         banyakPemasukanPadaTanggal.push(d.banyakPemasukan);
                    });
                    var c = document.getElementById('chartPenjualan').getContext('2d');

                    c = new Chart(c, {
                         type: 'line',
                         data: {
                              labels: tanggalan,
                              datasets: [{
                                   label: 'Pemasukan Harian',
                                   data: banyakPemasukanPadaTanggal,
                                   backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                   borderColor: 'rgba(255, 99, 132, 0.5)',
                                   borderWidth: 2,
                                   fill: true
                              }
                              ]
                         },
                         options: {
                              responsive: true,
                              scales: {
                                   xAxes: [{
                                        display: true,
                                        scaleLabel: {
                                             display: true,
                                             labelString: 'Tanggal'
                                        }
                                   }],
                                   yAxes: [{
                                        display: true,
                                        scaleLabel: {
                                             display: true,
                                             labelString: 'Banyak Rupiah'
                                        }
                                   }]
                              },
                              tooltips: {
                                   mode: 'index',
                                   intersect: false,
                              },
                              hover: {
                                   mode: 'nearest',
                                   intersect: true
                              },
                              title: {
                                   display: true,
                                   text: 'PERKEMBANGAN TOKO ' + _namaToko
                              },
                         }
                    });
               }
          });

          $('#rowStat').attr('loaded', '1');
     }

     $.ajax({
          url: '/stat',
          method: 'GET',
          success: function (data) {
               $('#totalTransaksiMasuk').html(data[0]);
               $('#totalTransaksiHariIni').html('+' + data[2] + ' Hari Ini');

               // 
               $('#totalProdukMasuk').html(data[1]);
               $('#totalProdukBulanIni').html('+' + data[3] + ' Bulan Ini');
          }
     });
});