<?php

use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Trainer;
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
    return view('admin.welcome');
});

Route::middleware('auth:admin')->group(function() {
    Route::get('trainers', [TrainerController::class,'top'])->name('trainer.top');
    Route::post('trainers/search',[TrainerController::class,'search'])->name('trainer.search');
    Route::get('trainer/detail/{trainer}',[TrainerController::class,'detail'])->name('trainer.detail');
    Route::get('trainer/stop_account/{trainer}',[TrainerController::class,'stop_account'])->name('trainer.stop_account');
    Route::get('trainer/stop_trainer/',[TrainerController::class,'stop_trainer'])->name('trainer.stop_trainer');
    Route::post('trainers/stop_trainer_search',[TrainerController::class,'stop_trainer_search'])->name('trainer.stop_trainer_search');
    Route::post('trainer/restore',[TrainerController::class,'restore'])->name('trainer.restore');
    Route::post('trainer/force_delete',[TrainerController::class,'force_delete'])->name('trainer.force_delete');

    Route::get('users/top',[UserController::class,'top'])->name('user.top');
    Route::post('users/search',[UserController::class,'search'])->name('user.search');
    Route::post('user/delete',[UserController::class,'delete'])->name('user.delete');
    Route::get('users/stop_user',[UserController::class,'stop_user'])->name('user.stop_user');
    Route::post('users/stop_user_search',[UserController::class,'stop_user_search'])->name('user.stop_user_search');
    Route::post('user/restore',[UserController::class,'restore'])->name('user.restore');
    Route::post('user/force_delete',[UserController::class,'force_delete'])->name('user.force_delete');
});


require __DIR__.'/adminAuth.php';