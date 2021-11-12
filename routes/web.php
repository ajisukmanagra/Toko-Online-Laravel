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

Route::get('/welcome', function () {
  return view('welcome');
});

Route::get('/clear-cache', function () {
  Artisan::call('config:clear');
  Artisan::call('cache:clear');
  Artisan::call('config:cache');
  return 'DONE';
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
  Route::middleware(['role'])->group(function () {
    Route::resource('/merek', 'MerekController');
    Route::resource('/order', 'OrderController');
    Route::get('/order/tampil_cancel', 'OrderController@tampil_cancel')->name('order.tampil_cancel');
    Route::get('/order/tampil_bayar', 'OrderController@tampil_bayar')->name('order.tampil_bayar');
    Route::get('/order/tampil_pending', 'OrderController@tampil_pending')->name('order.tampil_pending');
    Route::resource('/akun', 'AkunController');
    Route::resource('/produk', 'DataController');
    Route::get('/create/data', 'DataController@create')->name('create.data');
    Route::get('/data/tampil_hapus', 'DataController@tampil_hapus')->name('data.tampil_hapus');
    Route::get('/data/restore/{id}', 'DataController@restore')->name('data.restore');
    Route::post('/data/store', 'DataController@store')->name('data.store');
    Route::get('/data/index', 'DataController@index')->name('data.index');
    Route::post('/data/destroy', 'DataController@destroy')->name('data.destroy');
    Route::get('/data/edit/{id}', 'DataController@edit')->name('data.edit');
    Route::patch('/data/update/{id}', 'DataController@update')->name('data.update');
    Route::get('/data/delete/{id}', 'DataController@delete')->name('data.delete');
    Route::delete('/data/kill/{id}', 'DataController@kill')->name('data.kill');
  });

  Route::get('/', 'DataController@home')->name('home');
  Route::get('/home', 'DataController@home')->name('home');
  Route::get('/favorite', 'DataController@favorite')->name('favorite');
  Route::get('/like/{id}', 'DataController@like')->name('like');
  Route::get('/unlike/{id}', 'DataController@unlike')->name('unlike');
  Route::get('/cart', 'DataController@cart')->name('cart');
  Route::get('/add-to-cart/{id}', 'DataController@addToCart')->name('add-to-cart');
  Route::get('/data/{id}', 'DataController@show')->name('data.show');
  Route::get('/profil/{id}', 'AkunController@profil')->name('profil');
  Route::get('/edit_profil/{id}', 'AkunController@edit_profil')->name('edit_profil');
  Route::post('/akun/simpan/{id}', 'AkunController@simpan')->name('akun.simpan');
  Route::patch('/update_cart', 'DataController@update_cart')->name('update_cart');
  Route::delete('/remove', 'DataController@remove')->name('remove');
  Route::delete('/order/{id}', 'OrderController@destroy')->name('order.destroy');
  Route::get('/cekout', 'DataController@cekout')->name('cekout');
  Route::get('/category/{id}', 'DataController@category')->name('category');
  Route::get('/history', 'OrderController@history')->name('history');
  Route::get('/pembayaran/success', 'OrderController@success')->name('pembayaran.success');
  Route::get('/pembayaran/{id}', 'OrderController@pembayaran')->name('pembayaran');
  Route::patch('/proses_pembayaran/{id}', 'OrderController@proses_pembayaran')->name('proses_pembayaran');
  Route::post('/proses_cekout/{id}', 'DataController@proses_cekout')->name('proses_cekout');
});
