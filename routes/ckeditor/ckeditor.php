<?php

use App\Http\Controllers\CKEditorController;

Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
