<?php

use App\Http\Controllers\SysadminController;
use Illuminate\Support\Facades\Route;



Route::prefix('sysadmin')->group(function () {

    Route::get('/login', [SysadminController::class, 'index'])->name('sysadmin.login_form');
    Route::post('/login/owner', [SysadminController::class, 'login'])->name('sysadmin.login');
    Route::get('/dashboard', [SysadminController::class, 'dashboard'])->name('sysadmin.dashboard')->middleware('sysadmin');
    Route::get('/logout', [SysadminController::class, 'logout'])->name('sysadmin.logout')->middleware('sysadmin');
});
