<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'user\HomeController@index')->name('user.home');
Route::get('/produk', 'user\ProdukController@index')->name('user.produk');
Route::get('/produk/search', 'user\ProdukController@search')->name('user.produk-search');
Route::get('/produk/category/{key}', 'user\ProdukController@category')->name('user.produk-category');
Route::get('/produk/{slug}', 'user\ProdukController@detail')->name('user.produk-detail');
Route::middleware(['auth'])
    ->group(function(){
        // Route::get('/home', 'HomeController@index')->name('home');
        //Pesanan
        Route::get('/pesanan', 'user\PesananController@index')->name('user.pesanan');
        Route::get('/pesanan/{id}', 'user\PesananController@show')->name('user.pesanan-show');
        Route::post('/pesanan/{id}', 'user\PesananController@bukti')->name('user.pesanan-bukti');
        //produk
        
        
        Route::post('/produk/{id}', 'user\ProdukController@addProduct')->name('user.produk-add');

        //keranjang
        Route::get('/keranjang', 'user\KeranjangController@index')->name('user.keranjang');
        Route::post('/keranjang/getKota', 'user\KeranjangController@getKota')->name('user.keranjang-getKota');
        Route::post('/keranjang/addQty', 'user\KeranjangController@addQty')->name('user.keranjang-addQty');
        Route::post('/keranjang/getOngkir', 'user\KeranjangController@getOngkir')->name('user.keranjang-getOngkir');
        Route::post('/keranjang/addTransaction', 'user\KeranjangController@addTransaction')->name('user.keranjang-addTransaction');
        Route::delete('/keranjang/delete/{id}', 'user\KeranjangController@delete')->name('user.keranjang-delete');

        //Akun
        Route::get('/akun', 'user\AkunController@index')->name('user.akun');
        Route::post('/akun', 'user\AkunController@update')->name('user.akun-update');
    });

Route::middleware(['auth','admin'])
    ->group(function(){
        //dashboard
        Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');


        //product
        Route::get('/admin/daftar-produk', 'ProdukController@index')->name('admin.produk');
        Route::get('/admin/daftar-produk/create', 'ProdukController@create')->name('admin.produk-create');
        Route::get('/admin/daftar-produk/{id}', 'ProdukController@edit')->name('admin.produk-edit');
        Route::post('/admin/daftar-produk/store', 'ProdukController@store')->name('admin.produk-store');
        Route::post('/admin/daftar-produk/getDetail', 'ProdukController@getDetail')->name('admin.produk-getDetails');
        Route::post('/admin/daftar-produk/setStatus', 'ProdukController@setStatus')->name('admin.produk-setStatus');
        Route::put('/admin/daftar-produk/update/{id}', 'ProdukController@update')->name('admin.produk-update');
        Route::delete('/admin/daftar-produk/{id}/delete', 'ProdukController@delete')->name('admin.produk-delete');

        //Kategori
        Route::get('/admin/kategori', 'KategoriController@index')->name('admin.kategori');
        Route::get('/admin/kategori/create', 'KategoriController@create')->name('admin.kategori-create');
        Route::get('/admin/kategori/{id}', 'KategoriController@edit')->name('admin.kategori-edit');
        Route::post('/admin/kategori/store', 'KategoriController@store')->name('admin.kategori-store');
        Route::put('/admin/kategori/update/{id}', 'KategoriController@update')->name('admin.kategori-update');
        Route::delete('/admin/kategori/{id}/delete', 'KategoriController@delete')->name('admin.kategori-delete');

        //Pesanan
        Route::get('/admin/pesanan', 'PesananController@index')->name('admin.pesanan');
        Route::get('/admin/pesanan/konfirmasi', 'PesananController@konfirmasi')->name('admin.pesanan-konfirmasi');
        Route::get('/admin/pesanan/proses', 'PesananController@proses')->name('admin.pesanan-proses');
        Route::get('/admin/pesanan/kirim', 'PesananController@kirim')->name('admin.pesanan-kirim');
        Route::get('/admin/pesanan/kirim/{id}', 'PesananController@resi')->name('admin.pesanan-resi');
        Route::get('/admin/pesanan/selesai', 'PesananController@selesai')->name('admin.pesanan-selesai');
        Route::put('/admin/pesanan/valid/{id}', 'PesananController@valid')->name('admin.pesanan-valid');
        Route::put('/admin/pesanan/sampai/{id}', 'PesananController@sampai')->name('admin.pesanan-sampai');
        Route::post('/admin/pesanan/addResi/{id}', 'PesananController@addResi')->name('admin.pesanan-addResi');

        //Pelanggan
        Route::get('/admin/pelanggan', 'PelangganController@index')->name('admin.pelanggan');
        Route::delete('/admin/pelanggan/{id}/delete', 'PelangganController@delete')->name('admin.pelanggan-delete');

        //Profil
        Route::get('/admin/profil', 'ProfilController@index')->name('admin.profil-index');
        Route::get('/admin/profil/edit', 'ProfilController@edit')->name('admin.profil-edit');
        Route::put('/admin/profil/update', 'ProfilController@update')->name('admin.profil-update');
        Route::put('/admin/profil/update-password', 'ProfilController@update-password')->name('admin.profil-update-password');
    });
