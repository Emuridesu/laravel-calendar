<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProfileController;
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

// Route::post('/schedule-add', [ScheduleController::class, 'scheduleAdd'])->name('schedule-add');

// Route::post('/schedule-update', [ScheduleController::class, 'scheduleUpdate'])->name('schedule-update');

// Route::post('/schedule-get', [ScheduleController::class, 'scheduleGet'])->name('schedule-get');

// Route::post('/schedule-delete', [ScheduleController::class, 'scheduleDelete'])->name('schedule-delete');

Route::controller(ScheduleController::class)->group(function(){
    Route::post('/schedule-add','scheduleAdd')->name('schedule-add');
    Route::post('/schedule-update','scheduleUpdate')->name('schedule-update');
    Route::post('/schedule-get','scheduleGet')->name('schedule-get');
    Route::post('/schedule-delete','scheduleDelete')->name('schedule-delete');

});



Route::prefix('contacts')
->middleware(['auth'])
->controller(ScheduleController::class)
->name('contacts.')
->group(function () {
    Route::get('/calendar', 'index')->name('calendar');
    Route::get('/other-calendar', 'otherindex')->name('other-calendar');
    });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user-calendar' , [ScheduleController::class, 'userCalendar'])->middleware(['auth', 'verified'])->name('user-calendar');


Route::prefix('contacts')
->middleware(['auth'])
->controller(ContactFormController::class)
->name('contacts.')
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
});

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
