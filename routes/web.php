<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchemeRegisterController;
use App\Http\Controllers\UserManagementController;

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

Route::get('/scheme-implement', function () {
    return view('SchemeImplementationPhase');
});

Route::get('/test', [MapController::class, 'index'])->name('test');

// Route::get('dashboard/user/create', function () {
//     return view('user_create');
// });

Route::match(['get', 'post'], '/dashboard/user/create', [UserManagementController::class, 'user_create'])->name('user_create');
Route::match(['get', 'post'], '/dashboard/addUser', [UserManagementController::class, 'addUser'])->name('addUser');
Route::get('/dashboard/listUser', [UserManagementController::class, 'list_user'])->name('listUser');

require __DIR__ . '/auth.php';
