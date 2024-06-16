<?php

use App\Http\Controllers\CsvUploadController;

Route::get('/csv-upload', [CsvUploadController::class, 'index'])->name('csv.upload.form');
Route::post('/csv-upload', [CsvUploadController::class, 'upload'])->name('csv.upload');
