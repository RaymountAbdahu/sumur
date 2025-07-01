<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

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
    return view('welcome');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
// Route::get('/data', function () {
//     return view('data');
// });

Route::get('/dashboard', [DataController::class, 'dashboard'])->name('dashboard');
Route::get('/data', [DataController::class, 'table'])->name('table');
Route::post('/data/store', [DataController::class, 'store'])->name('data.store');
