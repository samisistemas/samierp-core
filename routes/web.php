<?php

use Illuminate\Support\Facades\Route;
use SamiSistemas\SamiERPCore\Http\Controllers\{LoginController, LogoutController};

Route::get('/login', LoginController::class)->name('login');
Route::get('/logout', LogoutController::class)->name('logout');
