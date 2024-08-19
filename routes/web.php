<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\generatePcontroller;
use App\Http\Controllers\authenticationController;

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
//     return view('welcome');
// });



Route::get('/',[pagesController::class,'index'])->name('home');
Route::get('/login',[pagesController::class,'login'])->middleware('guest');
Route::get('/register',[pagesController::class,'register'])->middleware('guest');



Route::get('/profile',[userController::class,'profile'])->middleware('auth');
Route::get('/logout',[authenticationController::class,'logout'])->middleware('auth');
Route::post('/createACC',[authenticationController::class,'create']);
Route::post('/authenticate',[authenticationController::class,'authenticate']);

Route::post('/saveGpassword',[generatePcontroller::class,'savePassword']);
Route::post('/getGpassword',[generatePcontroller::class,'getGpassword']);
Route::get('/saved',[generatePcontroller::class,'allGpassword']);
Route::post('/deleteGpass',[generatePcontroller::class,'deleteGpass']);
