<?php


use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AttendanceController;

//attendance as employee
Route::get('/employee/attendance', function () {
    return view('employee');
});

Route::get('/admin/attendance', function () {
    return view('admin/attendance');
});

Route::get('/admin/home', function () {
    return view('admin/home');
});

Route::get('/admin/employee', function () {
    return view('admin/employee');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/admin/login'); // Redirect to login page after logout
})->name('logout');

//login as admin
Route::get('/admin/login', function () {
    return view('admin/login');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login'); // Show login form
Route::post('/admin/login', [AuthController::class, 'login']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('admin.attendance'); // Admin Attendance Page
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home'); // Admin home Page

    Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee'); // Show employee list
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employees.store'); // Add new employee
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Delete employee
    Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');

});

Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');;
