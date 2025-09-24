<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\classcategoryController;
use App\Http\Controllers\admin\classsubjectController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\examcontroller;
use App\Http\Controllers\admin\qestioncontroller;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\admin\Uni_answer_qController;
use App\Http\Controllers\teacher\ExamController as TeacherExamController;
use App\Http\Controllers\teacher\QestionController as TeacherQestionController;
use App\Http\Controllers\teacher\TeacherController;
use App\Http\Controllers\user\UserController;
use App\Models\TeacherExam;

use function Pest\Laravel\get;

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout'); // optional
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::get('all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category/{id}', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    Route::controller(Uni_answer_qController::class)->group(function () {

        Route::get('/all/answer', 'AllAnswer')->name('all.answer');
        Route::get('/add/answer', 'AddAnswer')->name('add.answer');
        Route::post('/store/answer', 'StoreAnswer')->name('store.answer');
        Route::get('/edit/answer/{id}', 'EditAnswer')->name('edit.answer');
        Route::post('/update/answer', 'UpdateAnswer')->name('update.answer');
        Route::get('/delete/answer/{id}', 'DeleteAnswer')->name('delete.answer');
    });

    Route::controller(classsubjectController::class)->group(function() {
        Route::get('/all/subject' , 'AllSubject')->name('all.subject');
        Route::get('/add/subject' , 'AddSubject')->name('add.subject');
        Route::post('/store/subject' , 'StoreSubject')->name('store.subject');
        Route::get('/edit/subject/{id}' , 'EditSubject')->name('edit.subject');
        Route::post('/update/subject' , 'UpdateSubject')->name('update.subject');
        Route::get('/delete/subject/{id}' , 'DeleteSubject')->name('delete.subject');
    });

        Route::controller(classcategoryController::class)->group(function () {
        Route::get('/all/class/category', 'AllClassCategory')->name('all.class.category');
        Route::get('/add/class/category', 'AddClassCategory')->name('add.class.category');
        Route::post('/store/class/category', 'StoreClassCategory')->name('store.class.category');
        Route::get('/edit/class/category/{id}', 'EditClassCategory')->name('edit.class.category');
        Route::post('/update/class/category', 'UpdateClassCategory')->name('update.class.category');
        Route::get('/delete/class/category/{id}', 'DeleteClassCategory')->name('delete.class.category');
    });


    //start department
Route::controller(DepartmentController::class)->group(function () {
    Route::get('add/depart', 'AddDepart')->name('add.depart');
    Route::post('store/depart', 'StoreDepart')->name('store.depart');
    Route::get('all/depart', 'AllDepart')->name('all.depart');
    Route::get('edit/depart/{id}', 'EditDepart')->name('edit.depart');
    Route::post('depart/update/{id}', 'UpdateDepart')->name('update.depart');
    Route::get('delete/depart/{id}', 'DeleteDepart')->name('delete.depart');
});

Route::controller(ExamController::class)->group(function () {
    Route::get('/all/exam', 'AllExam')->name('all.exam');
    Route::get('/add/exam', 'AddExam')->name('add.exam');
    Route::post('/store/exam', 'StoreExam')->name('store.exam');
    Route::get('/exam/edit/{id}', 'EditExam')->name('exam.edit');
    Route::post('/exam/update/', 'UpdateExam')->name('exam.update');
    Route::get('/exam/delete/{id}', 'DeleteExam')->name('exam.delete');
});

Route::get('/get-subjects/{department_id}', [SubjectController::class, 'getSubjectsByDepartment']);


Route::controller(qestioncontroller::class)->group(function() {
    Route::get('/all/qestion' , 'AllQestion')->name('all.qestion');
    Route::get('/add/qestion' , 'AddQestion')->name('add.qestion');
    Route::post('store/qestion' , 'StoreQestion')->name('store.qestion');
    Route::get('/edit/qestion/{id}' , 'EditQestion')->name('edit.qestion');
    Route::post('update/qestion' , 'UpdateQestion')->name('update.qestion');
    Route::get('/qestion/delete/{id}', 'DeleteQestion')->name('delete.qestion');
});

});




Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'TeacherDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/logout', [TeacherController::class, 'TeacherLogout'])->name('teacher.logout');
     // optional


    Route::controller(TeacherQestionController::class)->group(function() {
        Route::get('/all/teacher/qestion' , 'AllTeacherQestion')->name('all.teacher.qestion');
        Route::get('/add/teacher/qestion' , 'AddTeacherQestion')->name('add.teacher.qestion');
        Route::post('store/teacher/qestion' , 'StoreTeacherQestion')->name('store.teacher.qestion');
        Route::get('/edit/teacher/qestion/{id}', 'EditTeacherQestion')->name('edit.teacher.qestion');
        Route::post('update/teacher/qestion' , 'UpdateTeacherQestion')->name('update.teacher.qestion');
        Route::get('/teacher/qestion/delete/{id}', 'DeleteTeacherQestion')->name('delete.teacher.qestion');
    });

       Route::controller(TeacherExamController::class)->group(function() {
        Route::get('/all/teacher/exam' , 'AllTeacherExam')->name('all.teacher.exam');
        Route::get('/add/teacher/exam' , 'AddTeacherExam')->name('add.teacher.exam');
        Route::post('store/teacher/exam' , 'StoreTeacherExam')->name('store.teacher.exam');
        Route::get('/edit/teacher/exam/{id}', 'EditTeacherExam')->name('edit.teacher.exam');
        Route::post('update/teacher/exam' , 'UpdateTeacherExam')->name('update.teacher.exam');
        Route::get('/teacher/qestion/exam/{id}', 'DeleteTeacherExam')->name('delete.teacher.exam');
    });

    Route::get('/get-teacher_subjects/{department_id}', [SubjectController::class, 'getSubjectsByDepartment']);
});





//  user routs group  start
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/finalexamdash', [UserController::class, 'UserFinalexamdash'])->name('user.finalexamdash');
    Route::get('/user/uprofile/userprofile', [UserController::class, 'UserProfile'])->name('user.uprofile.userprofile');
    Route::get('/user/uprofile/usereditprofile', [UserController::class, 'UserEditprofile'])->name('user.uprofile.usereditprofile');
    Route::post('/user/uprofile/update', [UserController::class, 'UserProfileUpdate'])->name('user.uprofile.update');
    Route::get('/user/uprofile/change-password', [UserController::class, 'UserChangepassword'])->name('user.uprofile.change-password');

    Route::post('/user/uprofile/update-password', [UserController::class, 'UserPasswordUpdate'])->name('user.uprofile.updatepassword');

    Route::get('/user/uni/unicode', [UserController::class, 'UserUnicode'])->name('user.unicode');
    Route::get('/user/uni/uniexam/{id}', [UserController::class, 'UserUniexam'])->name('user.uniexam');
    Route::post('user/varifycode', [UserController::class, 'UserVarifyCode'])->name('user.varifycode');

    Route::post('submit/exam', [UserController::class, 'SubmitExam'])->name('exam.submit');
    Route::get('/user/examresult', [UserController::class, 'UserExamResult'])->name('user.examresult');
    Route::get('/user/certificate', [UserController::class, 'UserCertificate'])->name('user.certificate');
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
    return view('auth.login');
});



require __DIR__ . '/auth.php';



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });