<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });



Route::get('/', [AuthController::class, 'index']);
Route::post('admin/postlogin', [AuthController::class, 'postlogin']);
Route::get('admin/logout', [AuthController::class, 'logout']);

Route::group(['prefix' => 'laundry', 'middleware' => ['auth']], function(){
    
    Route::get('dashboard', [FrontController::class, 'index']);
    Route::group(['middleware' => ['CekLogin:admin']], function(){

        //add user
        Route::get('user', [UserController::class, 'index']);
        Route::get('user/tambah',[UserController::class, 'create']);
        Route::post('user/tambahdata', [UserController::class, 'store']);
        Route::get('user/edit/{id}', [UserController::class, 'edit']);
        Route::post('user/update/{id}',[UserController::class, 'update']);
        Route::get('user/hapus/{id}', [UserController::class , 'hapus'] );

        //outlet
        Route::get('outlet', [OutletController::class, 'index']);
        Route::get('outlet/tambah', [OutletController::class, 'create']);
        Route::post('outlet/tambahdata', [OutletController::class, 'store']);
        Route::get('outlet/hapus/{id}', [OutletController::class, 'show']);
        Route::get('outlet/edit/{id}', [OutletController::class, 'edit']);
        Route::post('outlet/update/{id}',[OutletController::class, 'update']);

        //regis pelanggan
        Route::get('member', [MemberController::class, 'index']);
        Route::get('member/tambah',[MemberController::class,'create']);
        Route::post('member/tambahdata',[MemberController::class,'store']);
        Route::get('member/hapus/{id}',[MemberController::class,'show']);
        Route::get('member/edit/{id}', [MemberController::class,'edit']);
        Route::post('member/update/{id}', [MemberController::class,'update']);

        //paket
        Route::get('paket', [PaketController::class, 'index']);
        Route::get('paket/tambah', [PaketController::class, 'create']);
        Route::post('paket/tambahdata', [PaketController::class, 'store']);
        Route::get('paket/hapus/{id}', [PaketController::class, 'show']);
        Route::get('paket/edit/{id}', [PaketController::class, 'edit']);
        Route::post('paket/update/{id}', [PaketController::class, 'update']);
        

        //transaksi
        Route::get('transaksi', [TransaksiController::class,'index']);
        Route::get('belipaket', [TransaksiController::class,'belipaket']);
        Route::get('tambah/{id}', [TransaksiController::class, 'tambah']);
        Route::get('kurang/{id}', [TransaksiController::class,'kurang']);
        Route::get('transaksi/hapus/{id}', [TransaksiController::class,'hapus']);

        //laporan

    });


});
