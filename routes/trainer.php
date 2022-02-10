<?php

use App\Http\Controllers\Trainer\HomeController;
use App\Http\Controllers\Trainer\ProfileController;
use App\Http\Controllers\Trainer\RecordController;
use App\Http\Controllers\Trainer\ScheduleController;
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

Route::get('/', function () {
    return view('trainer.welcome');
})->name('welcome');


Route::middleware(['auth:trainers','throttle:10, 0.5'])->group(function() {
    Route::get('/top',[HomeController::class,'top'])->name('top');

    Route::get('/schedule/unapproved',[ScheduleController::class,'unapproved'])->name('schedule.unapproved');
    Route::get('/schedule/unapproved_detail/{schedule}',[ScheduleController::class,'unapproved_detail'])->name('schedule.unapproved_detail');
    Route::get('/schedule/approve_form/{schedule}',[ScheduleController::class,'approve_form'])->name('schedule.approve_form');
    Route::get('/schedule/contact_form/{schedule}',[ScheduleController::class,'contact_form'])->name('schedule.contact_form');
    Route::post('/schedule/contact/{schedule}',[ScheduleController::class,'contact'])->name('schedule.contact');
    Route::post('/schedule/approve/{schedule}',[ScheduleController::class,'approve'])->name('schedule.approve');
    Route::post('/schedule/cancel/{schedule}',[ScheduleController::class,'cancel'])->name('schedule.cancel');
    Route::post('/schedule/confirm',[ScheduleController::class,'confirm'])->name('schedule.comfirm');

    Route::get('record/top',[RecordController::class,'top'])->name('record.top');
    Route::post('record/research',[RecordController::class,'research'])->name('record.research');
    Route::get('record/detail/{schedule}',[RecordController::class,'detail'])->name('record.detail');
    Route::get('record/record_form/{schedule}',[RecordController::class,'record_form'])->name('record.record_form');
    Route::post('record/post_record/{schedule}',[RecordController::class,'post_record'])->name('record.post_record');
    Route::get('record/edit_form/{schedule}',[RecordController::class,'edit_form'])->name('record.edit_form');
    Route::post('record/edit/{schedule}',[RecordController::class,'edit'])->name('record.edit');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
    Route::get('/profile/create',[ProfileController::class,'create'])->name('profile.create');
    Route::post('/profile/create',[ProfileController::class,'store'])->name('profile.store');
    Route::get('/profile/edit_profile/{trainer_profile}',[ProfileController::class,'edit_profile'])->name('profile.edit_profile');
    Route::post('/profile/update/{trainer_profile}',[ProfileController::class,'update_profile'])->name('profile.update_profile');
    Route::get('/profile/create_plan/{trainer_profile}',[ProfileController::class,'create_plan'])->name('profile.create_plan');
    Route::post('/profile/store_plan/{profile}',[ProfileController::class,'store_plan'])->name('profile.store_plan');
    Route::get('/profile/edit_plan/{plan}',[ProfileController::class,'edit_plan'])->name('profile.edit_plan');
    Route::post('/profile/edit_plan/{plan}',[ProfileController::class,'update_plan'])->name('profile.update_plan');
    Route::get('/profile/delete_plan/{plan}',[ProfileController::class,'delete_plan'])->name('profile.delete_plan');
    Route::get('/profile/destroy/{plan}',[ProfileController::class,'destroy_plan'])->name('profile.destroy_plan');
});

require __DIR__.'/trainerAuth.php';