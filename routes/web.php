<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\RecordController;
use App\Http\Controllers\User\ReserveController;
use App\Http\Controllers\User\ScheduleController;
use App\Http\Controllers\User\UserController;
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

Route::get('/',[UserController::class,'index'])->name('top');
Route::post('/search',[UserController::class,'show'])->name('show');
Route::get('detail/{trainer}',[UserController::class,'detail'])->name('detail');

Route::post('/',[ContactController::class,'send'])->middleware('throttle:1, 1')->name('send');


Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

Route::middleware(['auth:users','throttle:10, 0.5'])->group(function() {
    Route::get('reserve/{plan}',[ReserveController::class,'reserve'])->name('reserve');
    Route::get('reserve_day/{td}/{plan}',[ReserveController::class,'reserve_day'])->name('reserve_day');
    Route::post('reserve_day',[ReserveController::class,'reserve_confirm'])->name('reserve_confirm');
    Route::post('reserve_submit',[ReserveController::class,'reserve_submit'])->name('reserve_submit');

    Route::get('schedule/top',[ScheduleController::class,'top'])->name('schedule.top');
    Route::get('schedule/unapproved',[ScheduleController::class,'unapproved'])->name('schedule.unapproved');
    Route::get('schedule/detail/{schedule}',[ScheduleController::class,'detail'])->name('schedule.detail');
    Route::get('schedule/contact_form/{schedule}',[ScheduleController::class,'contact_form'])->name('schedule.contact_form');
    Route::post('schedule/contact/{schedule}',[ScheduleController::class,'contact'])->name('schedule.contact');
    Route::post('schedule/cancel/{schedule}',[ScheduleController::class,'cancel'])->name('schedule.cancel');
    Route::post('schedule/confirm/{schedule}',[ScheduleController::class,'confirm'])->name('schedule.confirm');

    Route::get('record/top',[RecordController::class,'top'])->name('record.top');
    Route::post('record/research',[RecordController::class,'research'])->name('record.research');
    Route::get('record/detail/{schedule}',[RecordController::class,'detail'])->name('record.detail');
});

require __DIR__.'/auth.php';
