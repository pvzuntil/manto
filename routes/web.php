<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
route::get('/',function ()
{
  return redirect()->route('home');
});

route::get('/home', 'home@index')->name('home');
route::get('/confirm', 'home@confirm')->name('confirm');
//
route::get('/daftar', 'daftar@index')->name('daftar');
  route::post('/daftar', 'daftar@daftar')->name('postDaftar');
//
route::get('/masuk', 'masuk@index')->name('masuk');
  route::post('/masuk', 'masuk@masuk')->name('postMasuk');
//


//
route::get('/kate','kate@index')->name('kate');
  route::post('/kate','kate@tambah')->name('kateTambah');
  route::post('/kate-pro','kate@tambahInPro')->name('kateTambahInPro');
  route::post('/kate/{id}','kate@update');
  route::get('/kate/{id}/delete','kate@delete');
//

route::get('/produk','produk@index')->name('produk');
  route::post('/produk','produk@tambah')->name('produkTambah');
  route::post('/produk/{id}','produk@update');
  route::get('/produk/{id}/delete','produk@delete');


//

route::get('/riwayat','riwayat@index')->name('riwayat');
  route::get('/riwayat-{id}-{kodePembelian}','riwayat@hapus');

// 
route::get('/karyawan','karyawan@index')->name('karyawan');
  route::post('/karyawan','karyawan@tambah')->name('tambahKaryawan');
  route::post('/karyawan/delete','karyawan@delete')->name('hapusKaryawan');
  route::post('/karyawan/update','karyawan@update')->name('updateKaryawan');
// 
  route::get('/loadKaryawan','karyawan@load');
  route::post('/loadNama','karyawan@nama');
  route::post('/cekPassword','karyawan@cekPassword');
  route::get('/getDataKaryawan/{a}','karyawan@getDataKaryawan')->name('getDataKaryawan');
  // 

// 
route::get('/pengaturan','pengaturan@index')->name('pengaturan');
  route::post('/uploadImgProfil','pengaturan@uploadImgProfil')->name('uploadImgProfil');
  route::post('/uploadImgSampul','pengaturan@uploadImgSampul')->name('uploadImgSampul');

  route::post('/updateNama','pengaturan@updateNama')->name('updateNama');
  route::post('/updateNamaToko','pengaturan@updateNamaToko')->name('updateNamaToko');
  route::post('/updateEmail','pengaturan@updateEmail')->name('updateEmail');
//
route::get('/keluar', 'keluar@keluar')->name('keluar');
//
route::get('/addCo/{id}','checkout@add');
route::get('/addCo','checkout@tambah');
route::get('/sum','checkout@sum');
route::post('/theRealCheckOut','checkout@theRealCheckOut');
route::get('/end','checkout@end');
route::get('/laporanHarian','laporanHarian@index');
//

/*
|
|
||||| CONTOH LINK API YANG SAYA BUAT
|
|
*/


route::get('/gen/{id}','gen@index');
route::post('/gen','gen@post')->name('genPost');

// API AJAK JANGAN DI UBAH-UBAH YA !
// 
// APIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAP
// 
// 
// =========================================================== START AJAX


route::get('/loadData','gen@loadData');
route::get('/deleteData/{id}','gen@deleteData');
route::get('/hitungTotalHarga','gen@hitungTotalHarga');
route::get('/hitungTotalHarga2','gen@hitungTotalHarga2');
route::get('/loadJumlahBanyakBarang','gen@loadJumlahBanyakBarang');

route::post('/riwayatPembelian','gen@riwayatPembelian');

route::post('/updateBanyakBarangTambah','gen@updateBanyakBarangTambah');
route::post('/updateBanyakBarangKurang','gen@updateBanyakBarangKurang');

// LOAD KATEGORI DI VIEW PRODUK

route::get('/loadKategori','ajaxKategori@loadKategori');

// ============================================================== END AJAX

// TEMA 
route::get('/tema','tema@tema');

// PRINT

route::get('/print-{kodePembelian}','printNota@index');

// route::get('/print-{kodePembelian}/pdf','printNota@pdf');

// CHART

route::get('/chart','gen@loadChart');

// STATTISTIIK

route::get('/stat','stat@load');

// CROP IMAGE ===================]
route::post('/cropImgProfil','crop@imgProfil');
// route::post('/cropImgProfil', 'crop@imgProfil');

/*
|
|
|
|
|
|================================================
*/


//
route::get('try','tryCon@index');

