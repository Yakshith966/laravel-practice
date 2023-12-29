<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/register', function () {
//     return view('auth.register');
// });

Route::get('/register',[CandidateController::class,'register'])->name('register');
Route::get('/login', [CandidateController::class, 'login'])->name('login');

Route::post('/register-user',[CandidateController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CandidateController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[JobController::class,'getJobs'])->name('dashboard');
Route::post('/submit-application', [ApplicationController::class, 'submitApplication'])->name('submit-application');
Route::get('/logout', [CandidateController::class, 'logoutUser'])->name('logout');

// Route::middleware(['auth'])->group(function () {
//     // Routes requiring authentication
//     Route::get('/dashboard', [CandidateController::class, 'dashboard'])->name('dashboard');
//     // Add other authenticated routes here
// });


