<?php

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

Route::prefix('users')
    ->group(function () {
        Route::get('/', User::class)->name('users.index');
        Route::get('/create', UserCreate::class)->name('users.create');
        Route::get('/edit/{id}', UserCreate::class)->name('users.edit');
    });

Route::get('/', function () {
    return view('welcome');
});
