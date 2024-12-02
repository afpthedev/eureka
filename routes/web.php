<?php
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\VideoController;

Route::get('video-upload/{token}', [VideoController::class, 'showUploadForm'])->name('video.upload');
Route::post('video-upload/{token}', [VideoController::class, 'storeVideo']);
