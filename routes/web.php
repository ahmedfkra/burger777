<?php

use App\Http\Controllers\DownloadpdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Form;
use App\Http\Controllers\PdfController;
Illuminate\Support\Facades\Route::get('form', Form::class);

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
/*
use App\Http\Controllers\UserController;

Route::get('/user', [UserController::class, 'index']);
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/{record}/pdf', [App\Http\Controllers\DownloadpdfController::class, 'download'])->name('balance.pdf.download');
//Route::get('pdf/{order}', DownloadpdfController::class)->name('balance.pdf.download');
//Route::get('pdf/{order}', PdfController::class)->name('pdf');
