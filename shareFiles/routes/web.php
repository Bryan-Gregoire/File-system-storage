<?php

use App\Http\Controllers\StorageController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', "login");

Auth::routes();

Route::get('/home', [StorageController::class, 'index'])->name('home');
Route::get('/storage/{id_other_contact}', [StorageController::class, 'show'])->name('storage');
Route::post('/contact/store', [StorageController::class, 'contactStore']);

Route::post('/file/store', [FileController::class, 'fileStore']);
Route::get('/storage/files/{id_other_contact}', [StorageController::class, 'filesJson']);
Route::post('/file/delete', [FileController::class, 'fileDelete']);
Route::post('/file/download', [FileController::class, 'fileDownload']);

Route::post('/storage/{id_other_contact}/delete', [StorageController::class, 'contactRemove']);
Route::post('/invit/{id_sender}/store', [StorageController::class, 'invitStore']);
