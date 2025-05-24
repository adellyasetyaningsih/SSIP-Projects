<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\SubjectController ;
use App\Http\Controllers\Admin\StudentDataController;
use App\Http\Controllers\Admin\CategorySubjectController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AdminController;


/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great!s
| 
*/

// Halaman utama /home (bisa digunakan sebagai homepage atau welcome page)
Route::get('/home', function () {
    return view('homepage');
});

// Default login redirect ke student login
Route::get('/login', function () {
    return redirect()->route('login.student');
})->name('login');

// Student login & register
Route::get('/login/student', [AuthController::class, 'showStudentLoginForm'])->name('login.student');
Route::post('/login/student', [AuthController::class, 'login'])->name('login.student.submit');

// Admin login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login.admin');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('login.admin.submit');


// Register
Route::get('/register', [AuthController::class, 'showStudentRegistrationForm'])->name('register.student');
Route::post('/register', [AuthController::class, 'registerStudent'])->name('register.student.submit');

// Logout umum// Logout umum (baik student maupun admin)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contoh dashboard siswa (perlu middleware auth:web)
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware('auth:student') // Hanya bisa diakses jika login sebagai student
    ->name('student.dashboard');

// Contoh dashboard admin (perlu middleware auth:admin)
Route::middleware(['auth:admin', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});


// Rute untuk melihat kategori (misalnya untuk dashboard siswa)
Route::get('/category/{categoryId}', [StudentDashboardController::class, 'showCategory'])->name('category.show');


//Rute ke Subject
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
   Route::get('student/subject/{subject}', [SubjectController::class, 'show'])->name('subject.show');

});

// routes edit profile student web
Route::middleware('auth:web')->prefix('student')->name('student.')->group(function () {
    Route::get('profile', [StudentProfileController::class, 'show'])->name('profile');      // Preview profile
    Route::get('profile/edit', [StudentProfileController::class, 'edit'])->name('edit');     // Form edit
    Route::put('profile', [StudentProfileController::class, 'update'])->name('update'); // Save update
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard'); // Dashboard route
});



// route dari dashbord admin ke subject 

Route::middleware(['auth:admin', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route untuk halaman index kategori
    Route::get('categories', [CategorySubjectController::class, 'index'])->name('categories.index'); // ubah nama menjadi 'categories.index'

    // Route untuk form tambah kategori
    Route::get('categories/create', [CategorySubjectController::class, 'createCategory'])->name('categories.create'); // ubah nama menjadi 'categories.create'
    // Route untuk menyimpan kategori
    Route::post('categories', [CategorySubjectController::class, 'storeCategory'])->name('categories.store');

    // Route untuk form tambah mata pelajaran
    Route::get('subjects/create', [CategorySubjectController::class, 'createSubject'])->name('subjects.create');
    // Route untuk menyimpan mata pelajaran
    Route::post('subjects', [CategorySubjectController::class, 'storeSubject'])->name('subjects.store');

    // Route untuk edit kategori
    Route::get('categories/{id}/edit', [CategorySubjectController::class, 'editCategory'])->name('categories.edit');
    Route::put('categories/{id}', [CategorySubjectController::class, 'updateCategory'])->name('categories.update');

    // Route untuk edit mata pelajaran
    Route::get('subjects/{id}/edit', [CategorySubjectController::class, 'editSubject'])->name('subjects.edit');
    Route::put('subjects/{id}', [CategorySubjectController::class, 'updateSubject'])->name('subjects.update');

    // Route untuk delete kategori
    Route::delete('categories/{id}', [CategorySubjectController::class, 'destroyCategory'])->name('categories.destroy');

    // Route untuk delete mata pelajaran
    Route::delete('subjects/{id}', [CategorySubjectController::class, 'destroySubject'])->name('subjects.destroy');
});

//route timeslot
Route::middleware(['auth:admin', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route resource manual untuk TimeSlot
    Route::get('/timeslots', [TimeSlotController::class, 'index'])->name('timeslots.index');
    Route::get('/timeslots/create', [TimeSlotController::class, 'create'])->name('timeslots.create');
    Route::post('/timeslots', [TimeSlotController::class, 'store'])->name('timeslots.store');
    Route::get('/timeslots/{id}/edit', [TimeSlotController::class, 'edit'])->name('timeslots.edit');
    Route::put('/timeslots/{id}', [TimeSlotController::class, 'update'])->name('timeslots.update');
    Route::delete('/timeslots/{id}', [TimeSlotController::class, 'destroy'])->name('timeslots.destroy');
});


// Route teacher
Route::middleware(['auth:admin', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});



// ---------------- Students DATA ----------------

Route::middleware(['auth:admin', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/student', [StudentDataController::class, 'index'])->name('students.index');
    Route::post('/student', [StudentDataController::class, 'store'])->name('students.store');
    Route::get('/student/{student_id}/edit', [StudentDataController::class, 'edit'])->name('students.edit');
    Route::put('/student/{student_id}', [StudentDataController::class, 'update'])->name('students.update');
    Route::delete('/student/{student_id}', [StudentDataController::class, 'destroy'])->name('students.destroy');
    Route::get('/payments/{pay_ID}/edit', [StudentDataController::class, 'editPayment'])->name('payment.edit');
    Route::put('/payments/{pay_ID}', [StudentDataController::class, 'updatePayment'])->name('payment.update');
});




Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // ---------------- KATEGORI ----------------
    Route::get('/categories', [CategorySubjectController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategorySubjectController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [CategorySubjectController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [CategorySubjectController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [CategorySubjectController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategorySubjectController::class, 'destroyCategory'])->name('admin.categories.destroy');

    // ---------------- SUBJECT ----------------
    Route::get('/categories', [CategorySubjectController::class, 'index'])->name('admin.categories.index');
    Route::get('/subject/create', [CategorySubjectController::class, 'createSubject'])->name('admin.subject.create');
    Route::post('/subject', [CategorySubjectController::class, 'storeSubject'])->name('admin.subject.store');
    Route::get('/subject/{id}/edit', [CategorySubjectController::class, 'editSubject'])->name('admin.subject.edit');
    Route::put('/admin/subjects/{subject}', [CategorySubjectController::class, 'update'])->name('admin.subject.update');
    Route::delete('/subject/{id}', [CategorySubjectController::class, 'destroySubject'])->name('admin.subject.destroy');

});


Route::middleware(['auth:admin', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('admins/{admin_email}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('admins/{admin_email}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('admins/{admin_email}', [AdminController::class, 'destroy'])->name('admins.destroy');


});

