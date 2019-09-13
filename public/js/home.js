$(function () {
    // 
    $('#fullScreenBtn').on('click', () => {
        if (screenfull.enabled) {
            $('header').toggle();
            $('#sidenav').toggle();
            screenfull.toggle().then(() => {
                if (screenfull.isFullscreen) {
                    $('#iconFullScreen').html('fullscreen_exit');
                    $('main').toggleClass('paddingMain');
                } else {
                    $('#iconFullScreen').html('fullscreen');
                    $('main').toggleClass('paddingMain');

                }
            });
        }
    });

    $(document).on('keydown', (e) => {
        // console.log(e.keyCode);
        if (e.keyCode == 122 || e.keyCode == 27) {
            return false;
            // $('#fillScreenBtn').click();
        }
    });
    // 

    $('#sidenav').hover(function () {
        $(this).toggleClass('overH');

    });
    //

    // FORMAT RUPIAH

    // function formatRupiah(angka, prefix) {
    //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //         split = number_string.split(','),
    //         sisa = split[0].length % 3,
    //         rupiah = split[0].substr(0, sisa),
    //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
    //     if (ribuan) {
    //         separator = sisa ? '.' : '';
    //         rupiah += separator + ribuan.join('.');
    //     }
    //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // }

    $('#bayar').on('change', function (data) {
        var bayar = $(this).val();

        $.ajax({
            url: '/hitungTotalHarga2',
            method: 'GET',
            success: function (data) {
                var hitung = bayar - data;
                $('#kembalian').html(hitung);
            }
        });

    });

    $('#bayar').on('keyup', function (data) {
        var bayar = $(this).val();

        $.ajax({
            url: '/hitungTotalHarga2',
            method: 'GET',
            beforeSend: function () {
                $('#kembalian').html('...');
            },
            success: function (data) {
                var hitung = bayar - data;
                $('#kembalian').html(hitung);

                if ($('#bayar').val() == '') {
                    $('#lastBtn').addClass('disabled');
                } else {
                    if ($('#kembalian').html().charAt(0) == '-') {
                        $('#lastBtn').addClass('disabled');
                    } else {
                        $('#lastBtn').removeClass('disabled');
                    }
                }
            }
        });

    });

    $('#lastBtn').on('click', function () {
        var _token = $('#_tokenLaravel').val();
        var nama = $('#namaPelaggan').val();
        var bayar = $('#bayar').val();

        $.ajax({
            url: '/theRealCheckOut',
            method: 'POST',
            data: {
                namaPelanggan: nama,
                _token: _token,
                bayar: bayar
            },
            beforeSend: function () {
                $('.load').fadeIn('slow');
            },
            success: function (data) {
                if (data == '1') {
                    setTimeout(function () {
                        window.location.href = '/end';
                    }, 1000);
                }
            }
        });
    });

    // 
    $('#sidenav').sidenav();
    $('.materialboxed').materialbox();
    $('.modal').modal();
    $('.fixed-action-btn').floatingActionButton();


    //
    $('#paramCheck').change(function () {
        if ($(this).is(':checked')) {
            $('#btnSetuju').removeClass('disabled');
        } else {
            $('#btnSetuju').addClass('disabled');
        }
    });
});

$(document).ready(function () {
    function loadDataCheckOut() {
        $.ajax({
            url: '/loadData',
            method: 'GET',
            success: function (data) {
                $('#isiDataCo').html(data);
            }
        });
    }

    function loadJumlahBarang() {
        $.ajax({
            url: '/hitungTotalHarga',
            method: 'GET',
            success: function (data) {

                $('#fieldJumlah').html(data);

            }
        });
    }

    function loadJumlahBanyakBarang() {
        $.ajax({
            url: '/loadJumlahBanyakBarang',
            method: 'GET',
            beforeSend: function () {
                $('#jumlahBanyakBarang').addClass('loading');
            },
            success: function (data) {
                if (data == 0) {
                    $('#btnCheckOut').addClass('disabled');
                } else {
                    $('#btnCheckOut').removeClass('disabled');
                }
                $('#jumlahBanyakBarang').removeClass('loading');
                $('#jumlahBanyakBarang').text(data);
            }
        });
    }

    // 

    loadDataCheckOut();
    loadJumlahBarang();
    loadJumlahBanyakBarang();
    // 
    $('#key').keyup(function () {
        var query = $(this).val();

        if (query != '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '/gen',
                method: 'POST',
                data: {
                    query: query,
                    _token: _token
                },
                success: function (data) {
                    $('#result').fadeIn();
                    $('#result').html(data);
                }
            });
        } else {
            $('#result').fadeOut();
        }
    });

    $(document).on('click', 'li', function () {
        if ($(this).attr('id') == 'closeRes') {
            $('#result').fadeOut();
        }
    });

    $('#key').focus(function () {
        $('#result').fadeIn();
    });
    // 
    $(document).on('click', 'a', function () {
        var dataType = $(this).attr('data-type');
        var id = $(this).attr('id');

        if (dataType == 'produk') {
            $.ajax({
                url: '/addCo',
                method: 'GET',
                data: {
                    id: id
                },
                success: function () {
                    $('#result').fadeOut();
                    $('#key').val('');
                    loadDataCheckOut();
                    loadJumlahBarang();
                    loadJumlahBanyakBarang();
                }
            });
        }
    });

    $(document).on('click', 'button', function () {
        var dataType = $(this).attr('data-type');
        var id = $(this).attr('id-pro');

        if (dataType == 'btnHapusProCo') {
            $.ajax({
                url: '/deleteData/' + id,
                method: 'GET',
                success: function () {
                    loadDataCheckOut();
                    loadJumlahBanyakBarang();
                    loadJumlahBarang();
                }
            });

        }
    });


    //

    $(document).on('click', 'button', function () {
        var nameId = $(this).attr('id');

        if (nameId == 'btnTambahBanyak') {

            var target = $(this).attr('target-id-tambah');
            var targetProduk = $(this).attr('target-produk');
            var _token = $('#_tokenLaravel').val();

            var berapaBanyak = $('button#target' + target + '').text();

            $.ajax({
                url: '/updateBanyakBarangTambah',
                method: 'POST',
                data: {
                    id: target,
                    produk: targetProduk,
                    _token: _token,
                    banyak: berapaBanyak
                },
                beforeSend: function () {
                    $('button#target' + target + '').addClass('loading');
                },
                success: function (data) {
                    if (data == 'pass') {
                        swal({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            type: 'error',
                            title: 'Telah mencapai maximum pembelian',
                            backdrop: false
                        });
                        $('button#target' + target + '').removeClass('loading');
                    } else {
                        $('button#target' + target + '').removeClass('loading');
                        $('button#target' + target + '').html(data);
                        loadJumlahBanyakBarang();
                        loadJumlahBarang();

                    }
                }
            });
        } else if (nameId == 'btnKurangBanyak') {

            var target = $(this).attr('target-id-kurang');
            var targetProduk = $(this).attr('target-produk');
            var _token = $('#_tokenLaravel').val();

            var berapaBanyak = $('button#target' + target + '').text();

            if (berapaBanyak > 1) {
                $.ajax({
                    url: '/updateBanyakBarangKurang',
                    method: 'POST',
                    data: {
                        id: target,
                        produk: targetProduk,
                        _token: _token
                    },
                    beforeSend: function () {
                        $('button#target' + target + '').addClass('loading');
                    },
                    success: function (data) {
                        $('button#target' + target + '').removeClass('loading');
                        $('button#target' + target + '').html(data);
                        loadJumlahBanyakBarang();
                        loadJumlahBarang();
                    }
                });
            } else if (berapaBanyak <= 1) {
                swal({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    type: 'error',
                    title: 'Telah mencapai minimum pembelian',
                    backdrop: false
                });
            }
        }
    });

    $('#btnCheckOut').on('click', function () {
        var total = $('#fieldJumlah').text();

        $('#jumlahAkhir').html(total);

        $.ajax({
            url: '/sum',
            method: 'GET',
            beforeSend: function () {
                $('#loadingDatCo').addClass('disBl');
                $('#loadingDatCo').removeClass('disNo');
                $('#ringkasanCheckOut').html('');
                $('#ringkasanCheckOut').html('<div class="progress"><div class="indeterminate"></div></div>');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#loadingDatCo').addClass('disNo');
                    $('#loadingDatCo').removeClass('disBl');
                    $('#ringkasanCheckOut').html(data);
                }, 500);
            }
        });

    });

});