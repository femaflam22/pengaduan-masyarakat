<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AuthController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContentsExport;
use App\Exports\UsersExport;

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

// auth
Route::get('/check-login', [AuthController::class, 'check'])->name('check_for_login');
Route::post('/login/auth', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// report
Route::get('/', [ContentController::class, 'index'])->name('index');
Route::post('/report', [ContentController::class, 'store'])->name('report.store');
Route::get('/report/all', [ContentController::class, 'all'])->name('report.all');
Route::get('/report/{id}', [ContentController::class, 'show'])->name('report.show');
Route::patch('/report/{id}', [ContentController::class, 'update'])->name('report.update');

// report admin
Route::group(['middleware' => ['level']], function () {
    // report
    Route::get('/admin/report-table', [ContentController::class, 'reportAdmin'])->name('admin.report_table');
    Route::get('/reports/export-csv', function () {
        return Excel::download(new ContentsExport, 'reports.csv');
    })->name('admin.reports.export');
    // akun
    Route::get('/accounts', [AuthController::class, 'accounts'])->name('admin.accounts');
    Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('/register/create', [AuthController::class, 'create'])->name('admin.register.create');
    Route::get('/register/update/{id}', [AuthController::class, 'edit'])->name('admin.register.edit');
    Route::patch('/register/update/{id}', [AuthController::class, 'update'])->name('admin.register.update');
    Route::get('/users/export-csv', function () {
        return Excel::download(new UsersExport, 'users.csv');
    })->name('admin.users.export');
});