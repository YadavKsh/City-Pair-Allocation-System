<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/slots', [SlotController::class, 'index'])->name('slots.index');
Route::post('/slots', [SlotController::class, 'store'])->name('slots.store');
Route::put('/slots/{slot}', [SlotController::class, 'update'])->name('slots.update');
Route::delete('/slots/{slot}', [SlotController::class, 'destroy'])->name('slots.destroy');
