<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SectionController;
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

Route::get('/get-classes/{teacherId}', [TeacherController::class, 'getClassesByTeacher']);
// Place this custom route before the resource route ->middleware('permission:view campus');
Route::get('/get-teachers/{campusId}', [TeacherController::class, 'getTeachersByCampus']);
Route::get('/roles/assign-permissions-form', [RoleController::class, 'assignPermissionsForm'])->name('roles.assignPermissionsForm');
Route::post('/roles/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');
Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.revokePermission');
Route::get('/roles/{roleName}/permissions', [RoleController::class, 'getRolePermissions']);
// Applying permission-based middleware to each resource route
// Route::resource('campus', CampusController::class)->middleware('permission:view campus');
Route::get('campus', [CampusController::class, 'index'])->name('campus.index')->middleware('permission:view campus');
Route::get('campus/create', [CampusController::class, 'create'])->name('campus.create')->middleware('permission:create campus');
Route::post('campus', [CampusController::class, 'store'])->name('campus.store')->middleware('permission:create campus');
Route::get('campus/{campus}', [CampusController::class, 'show'])->name('campus.show')->middleware('permission:view campus');
Route::get('campus/{campus}/edit', [CampusController::class, 'edit'])->name('campus.edit')->middleware('permission:edit campus');
Route::put('campus/{campus}', [CampusController::class, 'update'])->name('campus.update')->middleware('permission:edit campus');
Route::delete('campus/{campus}', [CampusController::class, 'destroy'])->name('campus.destroy')->middleware('permission:delete campus');

Route::resource('evaluation', EvaluationController::class)->middleware('permission:view evaluation');
Route::resource('report', ReportCardController::class)->middleware('permission:view report');
Route::resource('roles', RoleController::class)->middleware('permission:manage roles');
Route::resource('permissions', PermissionController::class)->middleware('permission:manage permissions');
Route::resource('teacher', TeacherController::class)->middleware('permission:view teachers');
Route::resource('user', UserController::class)->middleware('permission:view users');
Route::resource('seniorevaluation', SeniorEvaluationReportController::class)->middleware('permission:view senior evaluation');
Route::resource('subjects', SubjectController::class);
Route::resource('sections', SectionController::class);
Route::post('/sections/import', [SectionController::class, 'import'])->name('sections.import');


// end apply middleware
// Route::get('/roles/assign-permissions-form', [RoleController::class, 'assignPermissionsForm'])->name('roles.assignPermissionsForm');
// Route for assigning roles to users


Route::get('seniorevaluation/{id}/download', [SeniorEvaluationReportController::class, 'downloadEvaluationPDF'])->name('seniorevaluation.download');
Route::post('/seniorevaluation/save', [SeniorEvaluationReportController::class, 'save'])->name('seniorevaluation.save');

Route::get('evaluation/{id}/download', [EvaluationController::class, 'downloadPDF'])->name('evaluation.download');
Route::post('/evaluation/save', [EvaluationController::class, 'save'])->name('evaluation.save');
Route::get('/get-sections-by-class', [SectionController::class, 'getSectionsByClass'])
    ->name('get.sections.by.class');
    Route::get('/get-subjects-by-section', [SubjectController::class, 'getSubjectsBySection'])
    ->name('get.subjects.by.section');
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


