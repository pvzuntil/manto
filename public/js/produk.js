$(function () {
    $('#sidenav').sidenav();
    $('.materialboxed').materialbox();
    $('.fixed-action-btn').floatingActionButton();
    $('.materialize-textarea').characterCounter();
    $('.tooltiped').tooltip();
    $('.modal').modal();
    $('.select').formSelect();
    $('.ui.dropdown').dropdown();

    // $('#tableProduk').DataTable();

    // $('#idKat').append('<option>makananananan</option>');

    // 
    $('#harga, #hargaBeli').on('keyup', function(){
        if($('#harga').val() != '' && $('#hargaBeli').val() != ''){
            $('#hargaChecker').val($('#harga').val() - $('#hargaBeli').val());
    
            if($('#hargaChecker').val().charAt(0) == '-'){
                // swal('minus');
                $('#simpanPro').addClass('disabled');
            }else{
                $('#simpanPro').removeClass('disabled');
            }
        }else{
            $('#simpanPro').addClass('disabled');
        }
    });

    
    $('.tambahTrigger').click(function () {
        $('#fieldTambahKat').animate({
            height: 'toggle'
        });
        $('.fixed-action-btn').addClass('scale-out');
        $('.fixed-action-btn').removeClass('scale-in');
        $('#nama').focus();
    
    });
    
    $('.batalTrigger').click(function () {
        $('#fieldTambahKat').animate({
            height: 'toggle'
        });
        $('.fixed-action-btn').removeClass('scale-out');
        $('.fixed-action-btn').addClass('scale-in');
    });

    function loadKat() {
        $.ajax({
            url: '/loadKategori',
            method: 'GET',
            beforeSend: function () {
                $('#loading').removeClass('disNo');
            },
            success: function (data) {
                $('#loading').addClass('disNo');
                $('#idKat').empty();
                $.each(data, function (i, kat) {
                    if (data == kat.kodeKat) {
                        // $('#idKat').append('<option value="" disabled selected>Pilih Kategori</option>');
                        $('#idKat').append('<optgroup label="Kode - ' + kat.kodeKat + '"><option value="' + kat.id + '" selected>' + kat.nama + '</option></optgroup>');

                    } else {

                        $('#idKat').append('<optgroup label="Kode - ' + kat.kodeKat + '"><option value="' + kat.id + '" selected>' + kat.nama + '</option></optgroup>');

                    }
                });
                $('#idKat').append('<option value="addKat" data-icon="/add.png" id="addKat">Tambah kategori baru</option>');
            }
        });
    };
    loadKat();

    $('#idKat').on('change', function () {
        if ($(this).val() == 'addKat') {
            $('#simpanPro').addClass('disabled');
            $('#modalTambahKategoriBtn').click();
        } else {
            $('#simpanPro').removeClass('disabled');
        }
    });

    $('#tambahKategoriBtn').on('click', function () {
        var nama = $('#namaKat').val();
        var kodeKat = $('#kodeKat').val();
        var desKat = $('#desKat').val();
        var _token = $('#_tokenLaravel').val();

        $.ajax({
            url: '/kate-pro',
            method: 'POST',
            data: {
                _token: _token,
                nama: nama,
                kodeKat: kodeKat,
                desKat: desKat
            },
            success: function (data) {
                if (data == 'tambahKatGagal') {
                    swal({
                        title: 'Gagal !',
                        type: 'error',
                        text: 'Gagal menambah kategori, kode kategori ada yang sama, silahkan ulangi sekali lagi !'
                    });
                } else {
                    swal({
                        title: 'Berhasil !',
                        type: 'success',
                        text: 'Berhasil menambah kategori !'
                    });
                    $('.modal-close').click();
                    $('#simpanPro').removeClass('disabled');
                    loadKat();
                }
            }
        });
    });
});