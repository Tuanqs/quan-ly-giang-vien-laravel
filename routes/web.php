<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // THÊM DÒNG NÀY
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\LecturerAcademicDegreeController; // Thêm
use App\Http\Controllers\Admin\LecturerWorkHistoryController;
use App\Http\Controllers\Admin\DegreeTypeController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\CourseOfferingBatchController;
use App\Http\Controllers\Admin\ScheduledClassController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Routes cho Đăng ký
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Routes cho Đăng nhập
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login'); // ĐẶT TÊN ROUTE LÀ 'login'
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

// Route cho Đăng xuất
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');




// Route cho Dashboard (yêu cầu đăng nhập)
Route::get('/dashboard', [DashboardController::class, 'index']) // Sửa thành dòng này
    ->middleware(['auth'])->name('dashboard');


// Các route quản lý khác đã có (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('admin/departments', DepartmentController::class);
    Route::resource('admin/lecturers', LecturerController::class);
    Route::resource('admin/degree-types', DegreeTypeController::class)
        ->parameters(['degree-types' => 'degreeType']);
    
    Route::resource('admin/academic-years', AcademicYearController::class)
        ->parameters(['academic-years' => 'academicYear']);

     Route::resource('admin/semesters', SemesterController::class)
        ->parameters(['semesters' => 'semester']);

     Route::resource('admin/subjects', SubjectController::class)
        ->parameters(['subjects' => 'subject']);

     Route::get('admin/course-offerings/open-batch', [CourseOfferingBatchController::class, 'create'])->name('admin.course-offerings.open-batch.create');
    Route::post('admin/course-offerings/open-batch', [CourseOfferingBatchController::class, 'store'])->name('admin.course-offerings.open-batch.store');

     Route::resource('admin/scheduled-classes', ScheduledClassController::class)
        ->parameters(['scheduled-classes' => 'scheduledClass']); // Để route model binding nhận đúng tên biến $scheduledClass

    // === QUẢN LÝ HỌC VỊ CỦA GIẢNG VIÊN ===
    Route::prefix('admin/lecturers/{lecturer}/academic-degrees')->name('admin.lecturers.academic-degrees.')->group(function () {
        Route::get('/create', [LecturerAcademicDegreeController::class, 'create'])->name('create');
        Route::post('/', [LecturerAcademicDegreeController::class, 'store'])->name('store');
        Route::get('/{degree}/edit', [LecturerAcademicDegreeController::class, 'edit'])->name('edit');
        Route::put('/{degree}', [LecturerAcademicDegreeController::class, 'update'])->name('update');
        Route::delete('/{degree}', [LecturerAcademicDegreeController::class, 'destroy'])->name('destroy');
    });

    // === QUẢN LÝ QUÁ TRÌNH CÔNG TÁC CỦA GIẢNG VIÊN ===
    Route::prefix('admin/lecturers/{lecturer}/work-histories')->name('admin.lecturers.work-histories.')->group(function () {
        Route::get('/create', [LecturerWorkHistoryController::class, 'create'])->name('create');
        Route::post('/', [LecturerWorkHistoryController::class, 'store'])->name('store');
        Route::get('/{history}/edit', [LecturerWorkHistoryController::class, 'edit'])->name('edit');
        Route::put('/{history}', [LecturerWorkHistoryController::class, 'update'])->name('update');
        Route::delete('/{history}', [LecturerWorkHistoryController::class, 'destroy'])->name('destroy');
    });
});