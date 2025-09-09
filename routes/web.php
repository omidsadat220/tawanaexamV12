<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\Uni_answer_qController;
use App\Http\Controllers\teacher\TeacherController;
use App\Http\Controllers\user\UserController;





Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout'); // optional
    }); 

    Route::controller(CategoryController::class)->group(function() {

        Route::get('all/category' , 'AllCategory')->name('all.category');
        Route::get('/add/category' , 'AddCategory')->name('add.category');
        Route::post('/store/category' , 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}' , 'EditCaategory')->name('edit.category');
        Route::post('/update/category/{id}', 'UpdateCategory')->name('update.category'); 
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category'); 
    });

    Route::controller(Uni_answer_qController::class)->group(function() {

        Route::get('/all/answer' , 'AllAnswer')->name('all.answer');
        Route::get('/add/answer' , 'AddAnswer')->name('add.answer');
        Route::post('/store/answer' , 'StoreAnswer')->name('store.answer');

    });

});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'TeacherDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/logout', [TeacherController::class, 'TeacherLogout'])->name('teacher.logout'); // optional
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout'); // optional
    Route::get('/user/About', [UserController::class, 'UserAbout'])->name('user.about'); // optional

});


/**
 * After login, send users to their role dashboard automatically:
 */
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match ($user?->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        default   => redirect()->route('user.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
