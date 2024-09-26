<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Login;
use App\Livewire\User\EditUser;
use App\Livewire\User\User;
use App\Livewire\User\UserCreate;
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
Route::middleware('auth')->group(function(){
    Route::prefix('users')
    ->group(function () {
        Route::get('/', User::class)->name('users.index');
        Route::get('/edit/{id}', UserCreate::class)->name('users.edit');
    });
});

Route::get('/create', UserCreate::class)->name('users.create');



Route::get('/', function () {
    return redirect()->route('login');
});
