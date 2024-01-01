<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Models\User;




// check result by default

Route::group(['controller' => SiteController::class], function() {
    Route::get('/', 'index')->name('check-result');
    Route::post('result', 'getResult')->name('result');
});




/*
    ------------------------------------
                Admin Routes
    ------------------------------------
*/

Route::any('/admin/login', [AdminController::class, 'login'])->middleware("throttle:5,1")->name('login');

Route::group(['prefix'=>'admin', 'middleware' => 'auth', 'controller' => AdminController::class], function() {
Route::get('/', 'index')->name('dashboard');



// logout
Route::get('/logout', 'logout')->name('logout');


// Sessions
Route::group(['middleware' => 'onlyAdmin'], function() {
    Route::any('sessions/create', 'createSession')->name('create-session');

    Route::get('sessions','showSessions')->name('sessions');

    Route::any('sessions/{id}/edit', 'editSession')->name('edit-session');

    Route::post('sessions/{id}/delete', 'deleteSession')->name('delete-session');





// Subjects and Combos
Route::any('subjects/create', 'createSubject')->name('create-subject');

Route::get('subjects', 'showSubjects')->name('subjects');

Route::any('subjects/{id}/edit', 'editSubject')->name('edit-subject');

Route::any('subjects/{id}/delete', 'deleteSubject')->name('delete-subject');


Route::any('combos/create', 'createSubjectCombo')->name('create-subject-combo');

Route::get('combos', 'showSubjectCombos')->name('subject-combos');

Route::get('combos/{id}/toggle', 'toggleSubjectCombo')->name('toggle-subject-combo');

Route::post('combos/{id}/delete', 'deleteSubjectCombo')->name('delete-subject-combo');

});


// Students
Route::any('students/create', 'createStudent')->name('create-student');

Route::get('students', 'showStudents')->name('students');

Route::any('students/{id}/edit', 'editStudent')->name('edit-student');

Route::any('students/{id}/delete', 'deleteStudent')->name('delete-student');


//Results
Route::any('results/create', 'createResult')->name('create-result');

Route::get('results', 'showResults')->name('results');

Route::any('results/{id}/edit', 'editResult')->name('edit-result');

Route::post('results/{id}/delete', 'deleteResult')->name('delete-result');




// settings
Route::middleware('onlyAdmin')->group(function () {
    Route::any('teachers/create', 'createTeacher')->name('create-teacher');

    Route::any('teachers/{id}/edit', 'editTeacher')->name('edit-teacher');

    Route::any('teachers/{id}/delete', 'deleteTeacher')->name('delete-teacher');

    Route::get('teachers', 'showTeachers')->name('teachers');

    Route::middleware('pin')->group(function () {

    Route::any('pins/create', 'createPin')->name('create-pin');
    Route::any('pin/{id}/edit', 'editPin')->name('edit-pin');
    Route::any('pin/{id}/delete', 'deletePin')->name('delete-pin');
    });




    Route::get('pins', 'showPins')->name('pins');

    Route::any('students/promote', 'promote')->name('promote');

    Route::any('settings/change', 'changeSettings')->name('change-settings');

});

Route::any('password/change', 'changePassword')->name('change-password');

Route::any('profile/edit', 'editProfile')->name('edit-profile');

Route::post('subjects/get', 'getSubjects')->name('get-subjects');



});
Route::get('test', function() {
    return view('admin.test');
});









