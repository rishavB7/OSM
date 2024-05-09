<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\SchemeRegisterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SchemeManagementController;
use App\Http\Controllers\DepartmentManagementController;
use App\Http\Controllers\NotificationsController;


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

Route::get('/scheme-create', [SchemeRegisterController::class, 'schemeCreate'])->middleware(['auth', 'verified'])->name('schemeCreate');
Route::post('/scheme-create', [SchemeRegisterController::class, 'schemeCreate'])->middleware(['auth', 'verified'])->name('schemeCreate');
Route::get('/listScheme', [SchemeRegisterController::class, 'listScheme'])->name('listScheme');
Route::get('/listSchemeDC', [SchemeRegisterController::class, 'listSchemeDC'])->name('listSchemeDC');
Route::get('/runningSchemesList', [SchemeRegisterController::class, 'runningSchemesList'])->name('runningSchemesList');
Route::get('/runningSchemesListDC', [SchemeRegisterController::class, 'runningSchemesListDC'])->name('runningSchemesListDC');
Route::get('/runningSchemesListHod', [SchemeRegisterController::class, 'runningSchemesListHod'])->name('runningSchemesListHod');
Route::get('/completedSchemesList', [SchemeRegisterController::class, 'completedSchemesList'])->name('completedSchemesList');
Route::get('/completedSchemeListDC', [SchemeRegisterController::class, 'completedSchemeListDC'])->name('completedSchemeListDC');
Route::get('/completedSchemeListHod', [SchemeRegisterController::class, 'completedSchemeListHod'])->name('completedSchemeListHod');
Route::get('/schemes/{id}/update', [SchemeRegisterController::class, 'updateScheme'])->name('SchemeUpdate');
Route::post('/schemes/{id}/update', [SchemeRegisterController::class, 'updateScheme'])->name('SchemeUpdate');
Route::match(['get','post'], '/schemes/{id}/delete', [SchemeRegisterController::class, 'deleteScheme'])->name('SchemeDelete');
Route::get('/schemes/apply/{scheme}',[SchemeRegisterController::class, 'apply'])->name('schemes.apply')->middleware('auth');
Route::match(['get', 'post'],'/schemeInfo/{id}',[SchemeRegisterController::class, 'schemeInfo'])->name('schemeInfo');
Route::match(['get', 'post'],'/printSchemeInfo/{id}',[SchemeRegisterController::class, 'printSchemeInfo'])->name('printSchemeInfo');
Route::match(['get', 'post'],'/finishedSchemes',[SchemeRegisterController::class, 'finishedSchemes'])->name('finishedSchemes');

Route::get('/deptWiseSchemes', [SchemeRegisterController::class, 'deptWiseSchemes'])->name('deptWiseSchemes');

Route::get('/listSchemeNodal', [SchemeRegisterController::class, 'listNodalScheme'])->name('listNodalScheme');



Route::match(['get', 'post'],'/log/{schemeId}',[SchemeRegisterController::class, 'progressLog'])->name('progressLog');
Route::get('/printProgressLog/{schemeId}', [SchemeRegisterController::class, 'printProgressLog'])->name('printProgressLog');



Route::group(['middleware' => 'auth', 'prefix' => 'messages', 'as' => 'messages'], function () {
    Route::get('/', [MessagesController::class, 'index']);
    Route::get('create', [MessagesController::class, 'create'])->name('.create');
    Route::post('/', [MessagesController::class, 'store'])->name('.store');
    Route::get('{thread}', [MessagesController::class, 'show'])->name('.show');
    Route::put('{thread}', [MessagesController::class, 'update'])->name('.update');
    Route::delete('{thread}', [MessagesController::class, 'destroy'])->name('.destroy');
});

Route::get('/test', function() {
    return view('Master_Admin.dasboardNew');
});





// Route::get('/scheme-implement', function () {
//     return view('SchemeImplementationPhase');
// });

// Route::get('/test', [MapController::class, 'index'])->name('test');

// Route::get('dashboard/user/create', function () {
//     return view('user_create');
// });

Route::match(['get', 'post'], '/dashboard/user/create', [UserManagementController::class, 'user_create'])->name('user_create');
Route::match(['get', 'post'], '/dashboard/addUser', [UserManagementController::class, 'addUser'])->name('addUser');
Route::match(['get', 'post'], '/dashboard/addUserCAtoDC', [UserManagementController::class, 'addUserCAtoDC'])->name('addUserCAtoDC');
Route::match(['get', 'patch'], '/dashboard/UpdateUser/{id}', [UserManagementController::class, 'updateUser'])->name('updateUser');
// Route::match(['get', 'patch'], '/dashboard/UpdateUser/{id}', [UserManagementController::class, 'updateUserTest'])->name('updateUserTest');
Route::match(['get', 'post'], '/dashboard/update-password', [UserManagementController::class, 'update_password'])->name('update_password');
Route::get('/dashboard/listUser', [UserManagementController::class, 'list_user'])->name('listUser');



Route::get('/listOfDc', [UserManagementController::class, 'dc_list'])->name('dc_list');
Route::get('/listOfNodalOfficers', [UserManagementController::class, 'nodal_list'])->name('nodal_list');
Route::get('/actusers', [UserManagementController::class, 'active_user_list'])->name('active_user_list');

Route::match(['get', 'post'], '/dashboard/addDepartment', [DepartmentManagementController::class, 'addDepartment'])->name('addDepartment');
Route::get('/dashboard/departmentList', [DepartmentManagementController::class, 'departmentList'])->name('departmentList');
Route::get('/dashboard/departmentListCA_TO_DC', [DepartmentManagementController::class, 'departmentListCA_TO_DC'])->name('departmentListCA_TO_DC');
Route::get('/dashboard/printDepartmentListCA_TO_DC', [DepartmentManagementController::class, 'printDepartmentListCA_TO_DC'])->name('printDepartmentListCA_TO_DC');

Route::match(['get', 'post'], '/dashboard/create-notifications', [NotificationsController::class, 'createNotification'])->name('createNotification');
Route::get('/dashboard/ca-to-dc/notifications', [NotificationsController::class, 'ca_to_dc_notifications'])->name('ca_to_dc_notifications');
Route::get('/dashboard/ca-to-dc/delete-notifications/{id}', [NotificationsController::class, 'delete_notification'])->name('delete_notification');
Route::get('/dashboard/notices', [NotificationsController::class, 'notices'])->name('notices');


require __DIR__ . '/auth.php';