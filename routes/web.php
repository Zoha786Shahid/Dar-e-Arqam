<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;

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
// Route::resource('campus', CampusController::class);
Route::resource('campus', CampusController::class)->middleware('permission:view campus');
Route::resource('evaluation', EvaluationController::class);
Route::resource('teacher', TeacherController::class);
Route::resource('user', UserController::class);
Route::get('evaluation/{id}/download', [EvaluationController::class, 'downloadPDF'])->name('evaluation.download');
Route::post('/evaluation/save', [EvaluationController::class, 'save'])->name('evaluation.save');
Route::get('/get-teachers/{campusId}', [EvaluationController::class, 'getTeachers']);

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');



