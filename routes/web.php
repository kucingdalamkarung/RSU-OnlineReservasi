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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get("/admin", "AdminController@index")->name("admin");
Route::get("/admin/laporan", "AdminController@laporan")->name("admin_laporan");

// admin dokter routes
Route::get("/admin/dokter", "DokterController@index")->name("admin_dokter");
Route::get("/admin/dokter/tambah", "DokterController@addDokter")->name("new.dokter");
Route::get("/admin/dokter/hapus/{id}", "DokterController@destroy")->name("delete.dokter");
Route::get("/admin/dokter/edit/{id}", "DokterController@editDokter")->name("edit.dokter");

Route::post("/admin/dokter", "DokterController@storeDokter")->name("store.dokter");
Route::post("/admin/dokter/{id}", "DokterController@updateDokter")->name("update.dokter");

// admin jadwal routes
Route::get("/admin/jadwal", "JadwalController@index")->name("admin_jadwal");
Route::get("/admin/jadwal/tambah", "JadwalController@addJadwal")->name("new.jadwal");
Route::get("/admin/jadwal/edit/{id}", "JadwalController@editJadwal")->name("edit.jadwal");
Route::get("/admin/jadwal/hapus/{id}", "JadwalController@destroy")->name("delete.jadwal");

Route::post("/admin/jadwal/", "JadwalController@storeJadwal")->name("store.jadwal");
Route::post("/admin/jadwal/update/{id}", "JadwalController@updateJadwal")->name("update.jadwal");

// admin poli routes
Route::get("/admin/poliklinik", "PoliklinikController@index")->name("admin_poli");
Route::get("/admin/poliklinik/tambah", "PoliklinikController@addPoli")->name("new.poli");
Route::get("/admin/poliklinik/edit/{id}", "PoliklinikController@getPoli")->name("edit.poli");
Route::get("/admin/poliklinik/hapus/{noPoli}", "PoliklinikController@destroy")->name("delete.poli");

Route::post("/admin/poliklinik", "PoliklinikController@storePoli")->name("store.poli");
Route::post("/admin/poliklinik/update/{id}", "PoliklinikController@updatePoli")->name("update.poli");

// public page routes
Route::get("/", "PublicController@index")->name("index");
Route::get("/profile", "PublicController@profile")->name("profile");
Route::get("/poliklinik", "PublicController@poliklinik")->name("poliklinik");
Route::get("/jadwal-dokter", "PublicController@jadwal")->name("jadwal");
Route::get("/antrian", "PublicController@antrian")->name("antrian");
Route::get("/daftar-antrian", "PublicController@registerAntrian")->name("daftarAntri");
Route::post("/daftar-antrian", "PublicController@storeAntrian")->name("store.antrian");

// admin laporan
Route::get("/admin/laporan/periode/", "AdminController@laporanPeriode")->name("laporan_periode");
Route::get("/admin/laporan/periode/cari", "AdminController@periodeSrc")->name("laporan_periode_cari");

Route::get("/admin/laporan/pasien/", "AdminController@laporanPasien")->name("laporan_pasien");
Route::get("/admin/laporan/pasien/cari", "AdminController@pasienSrc")->name("laporan_pasien_cari");

Route::get("/admin/laporan/dokter/", "AdminController@laporanDokter")->name("laporan_dokter");
Route::get("/admin/laporan/dokter/cari", "AdminController@dokterSrc")->name("laporan_dokter_cari");

Route::get("/admin/laporan/poliklinik/", "AdminController@laporanPoliklinik")->name("laporan_poliklinik");
Route::get("/admin/laporan/poliklinik/cari", "AdminController@poliklinikSrc")->name("laporan_poliklinik_cari");

Route::get("/admin/laporan/penjamin/", "AdminController@laporanPenjamin")->name("laporan_penjamin");
Route::get("/admin/laporan/penjamin/cari", "AdminController@penjaminSrc")->name("laporan_penjamin_cari");

// export
Route::get("/export/laporan/periode/excel", "AdminController@exportLaporanPeriode")->name("export_perioder_excel");
Route::get("/export/laporan/periode/pdf", "AdminController@exportLaporanPeriodePDF")->name("export_perioder_pdf");

Route::get("/export/laporan/pasien/excel", "AdminController@exportLaporanPasien")->name("export_pasien_excel");
Route::get("/export/laporan/pasien/pdf", "AdminController@exportLaporanPasienPDF")->name("export_pasien_pdf");

Route::get("/export/laporan/dokter/excel", "AdminController@exportLaporanDokter")->name("export_dokter_excel");
Route::get("/export/laporan/dokter/pdf", "AdminController@exportLaporanDokterPDF")->name("export_dokter_pdf");

Route::get("/export/laporan/poliklinik/excel", "AdminController@exportLaporanPoliklinik")->name("export_poliklinik_excel");
Route::get("/export/laporan/poliklinik/pdf", "AdminController@exportLaporanPoliklinikPDF")->name("export_poliklinik_pdf");

Route::get("/export/laporan/penjamin/excel", "AdminController@exportLaporanPenjamin")->name("export_penjamin_excel");
Route::get("/export/laporan/penjamin/pdf", "AdminController@exportLaporanPenjaminPDF")->name("export_penjamin_pdf");

// print
Route::get("/export/laporan/periode/print", "AdminController@printLaporanPeriode")->name("export_perioder_print");
Route::get("/export/laporan/pasien/print", "AdminController@printLaporanPasien")->name("export_pasien_print");
Route::get("/export/laporan/dokter/print", "AdminController@printLaporanDokter")->name("export_dokter_print");
Route::get("/export/laporan/poliklinik/print", "AdminController@printLaporanPoliklinik")->name("export_poliklinik_print");
Route::get("/export/laporan/penjamin/print", "AdminController@printLaporanPenjamin")->name("export_penjamin_print");