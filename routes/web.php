<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeInvoicesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Auth::routes();

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () { //...

    //==============================dashboard============================
    Route::get('/', [IndexController::class, 'index'])->name('index');

    //==============================grades============================
    Route::prefix('/grades')->name('grades.')->controller(GradeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    //==============================classrooms============================
    Route::prefix('/class-room')->name('class-room.')->controller(ClassroomController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    //==============================Sections============================
    Route::prefix('/sections')->name('sections.')->controller(SectionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    //==============================parents============================
    Route::view('parents', 'livewire.parent.index')->name('parents.index');
    //==============================teachers============================
    Route::prefix('/teachers')->name('teachers.')->controller(TeacherController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    //==============================Students============================
    Route::prefix('/students')->name('students.')->controller(StudentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/show', 'show')->name('show');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

        Route::prefix('/images')->name('images.')->group(function () {
            Route::post('/upload', 'upload_attachment')->name('upload');
            Route::get('/{id}', 'download_attachment')->name('download');
            Route::delete('/{id}', 'destroy_attachment')->name('destroy');
        });
        //==============================Receipt-Students============================
        Route::prefix('/receipts')->name('receipts.')->controller(ReceiptStudentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });
    //==============================promotions============================
    Route::prefix('/promotions')->name('promotions.')->controller(PromotionsController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::post('/{id}', 'destroy')->name('destroy');
    });
    //==============================graduated============================
    Route::prefix('/graduated')->name('graduated.')->controller(GraduatedController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::post('/{id}', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
    });
    //==============================Fees-invoice============================
    Route::prefix('/fees')->name('fees.')->controller(FeeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        //==============================Fees-invoice============================
        Route::prefix('/invoices')->name('invoices.')->controller(FeeInvoicesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
        //==============================Processing-Students============================
        Route::prefix('/processings')->name('processings.')->controller(ProcessingFeeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });
    //==============================Payment============================
    Route::prefix('/payments')->name('payments.')->controller(PaymentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});


