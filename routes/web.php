<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\StudentController;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::prefix('students')->name('students.')->group(function () {
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::get('/edit/{StudentID}', [StudentController::class, 'edit'])->name('edit');
    Route::get('/destroy/{StudentID}', [StudentController::class, 'destroy'])->name('destroy');
    Route::get('/restore/{StudentID}', [StudentController::class, 'restore'])->name('restore');
    Route::put('/update', [StudentController::class, 'update'])->name('update');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
