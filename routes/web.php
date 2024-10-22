<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SeniorEvaluationReportController;


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
Route::resource('report', ReportCardController::class);
// Place this custom route before the resource route
Route::get('/roles/assign-permissions-form', [RoleController::class, 'assignPermissionsForm'])->name('roles.assignPermissionsForm');
Route::post('/roles/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');
Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.revokePermission');

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
// Route::get('/roles/assign-permissions-form', [RoleController::class, 'assignPermissionsForm'])->name('roles.assignPermissionsForm');
// Route for assigning roles to users

Route::resource('seniorevaluation', SeniorEvaluationReportController::class);
Route::get('seniorevaluation/{id}/download', [SeniorEvaluationReportController::class, 'downloadEvaluationPDF'])->name('seniorevaluation.download');
Route::post('/seniorevaluation/save', [SeniorEvaluationReportController::class, 'save'])->name('seniorevaluation.save');
Route::resource('teacher', TeacherController::class);
Route::resource('user', UserController::class);
Route::get('evaluation/{id}/download', [EvaluationController::class, 'downloadPDF'])->name('evaluation.download');
Route::post('/evaluation/save', [EvaluationController::class, 'save'])->name('evaluation.save');
Route::get('/get-teachers/{campusId}', [EvaluationController::class, 'getTeachers']);
// download
Route::get('reportcard/{id}/download', [ReportCardController::class, 'downloadReportCard'])->name('reportcard.download');
Route::post('/reportcard/saveas', [ReportCardController::class, 'saveAs'])->name('reportcard.saveas');
// Route::get('allrecords', [ReportCardController::class, 'allRecords']);
Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
