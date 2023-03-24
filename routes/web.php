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
//     return view('index');
// });
//         ruta,   contralador con su funcion
Route::get('/', 'App\Http\Controllers\ProductsContoller@indexProducts');
Route::post('/saveProduct', 'App\Http\Controllers\ProductsContoller@saveProduct')->name('saveProduct');
Route::post('/getProduct', 'App\Http\Controllers\ProductsContoller@getProduct')->name('getProduct');
Route::post('/deleteProduct', 'App\Http\Controllers\ProductsContoller@deleteProduct')->name('deleteProduct');

