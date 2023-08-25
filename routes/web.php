<?php

use App\Http\Controllers\SaveController;
use Illuminate\Support\Facades\Route;

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
Route::get('/a', function () {
    return view('abc');
});


Route::post('/save-canvas',[SaveController::class,'save']);
Route::post('/add-video',[SaveController::class,'addVideo']);