<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IpController;

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

Route::get('/', function () {
    return view('ip_form');
})->name('ip.form');

Route::get('/ip/data', [IpController::class, 'fetchData'])->name('ip.data');
Route::post('/ip/store', [IpController::class, 'store'])->name('ip.store');
Route::get('/ip/delete-all', [IpController::class, 'deleteAll'])->name('ip.deleteAll');
