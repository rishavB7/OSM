<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\SchemeRegisterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SchemeManagementController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/scheme-create', [SchemeRegisterController::class, 'schemeCreate'])->name('schemeCreate');
Route::post('/scheme-create', [SchemeRegisterController::class, 'schemeCreate'])->name('schemeCreate');
Route::get('/listScheme', [SchemeRegisterController::class, 'listScheme'])->name('listScheme');
Route::get('/schemes/{id}/update', [SchemeRegisterController::class, 'updateScheme'])->name('SchemeUpdate');
Route::post('/schemes/{id}/update', [SchemeRegisterController::class, 'updateScheme'])->name('SchemeUpdate');
Route::match(['get','post'], '/schemes/{id}/delete', [SchemeRegisterController::class, 'deleteScheme'])->name('SchemeDelete');
Route::get('/schemes/apply/{scheme}',[SchemeRegisterController::class, 'apply'])->name('schemes.apply')->middleware('auth');
Route::match(['get', 'post'],'/schemeInfo/{id}',[SchemeRegisterController::class, 'schemeInfo'])->name('schemeInfo');
Route::match(['get', 'post'],'/finishedSchemes',[SchemeRegisterController::class, 'finishedSchemes'])->name('finishedSchemes');






// Route::get('/scheme-implement', function () {
//     return view('SchemeImplementationPhase');
// });

Route::get('/test', [MapController::class, 'index'])->name('test');

// Route::get('dashboard/user/create', function () {
//     return view('user_create');
// });

Route::match(['get', 'post'], '/dashboard/user/create', [UserManagementController::class, 'user_create'])->name('user_create');
Route::match(['get', 'post'], '/dashboard/addUser', [UserManagementController::class, 'addUser'])->name('addUser');
Route::match(['get', 'patch'], '/dashboard/UpdateUser/{id}', [UserManagementController::class, 'updateUser'])->name('updateUser');
Route::get('/dashboard/listUser', [UserManagementController::class, 'list_user'])->name('listUser');
// Route::get('/dashboard/listUser', [UserManagementController::class, 'list_user_by_district'])->name('listUserByDistrict');

require __DIR__ . '/auth.php';
