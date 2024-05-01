<?php

use App\Http\Controllers\ScheduleController;
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
// Route::get('log',[ScheduleController::class, 'scheduleUpdate']);

Route::post('/schedule-add', [ScheduleController::class, 'scheduleAdd'])->name('schedule-add');

Route::post('/schedule-update', [ScheduleController::class, 'scheduleUpdate'])->name('schedule-update');

Route::post('/schedule-get', [ScheduleController::class, 'scheduleGet'])->name('schedule-get');

Route::post('/schedule-delete', [ScheduleController::class, 'scheduleDelete'])->name('schedule-delete');



Route::get('/calendar', function () {
    return view('calendar');
});

