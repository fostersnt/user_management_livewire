<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\User\User;
use Illuminate\Support\Facades\Route;

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

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('login', Login::class)->name('login')->middleware('guest');


// AUTH ROUTES
Route::middleware('auth')
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/users', User::class)->name('users.index');
    });

Route::get('/', function () {
    return redirect()->route('login');
});
