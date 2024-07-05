<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\InstituteGuardController;



/*-------------------------------------------Institute------------------------------------- */

/////////Routes for Institute user
Route::prefix('institutes')->group(function () {
    Route::middleware('institute')->group(function () {


        Route::put('{institute}/edit/password_change', [InstituteController::class, 'password_change'])->name('institutes.password_change');
        Route::get('{institute}/edit/password_change/create', [InstituteController::class, 'password_change_create'])->name('institutes.password_change_create');

        Route::put('{institute}/edit/email_change', [InstituteController::class, 'email_change'])->name('institutes.email_change');
        Route::get('{institute}/edit/email_change/create', [InstituteController::class, 'email_change_create'])->name('institutes.email_change_create');

        Route::get('dashboard', [InstituteGuardController::class, 'dashboard'])->name('institutes.dashboard');
        Route::get('logout', [InstituteGuardController::class, 'logout'])->name('institutes.logout');
    });

    Route::get('login', [InstituteGuardController::class, 'index'])->name('institutes.login_form');
    Route::post('login/owner', [InstituteGuardController::class, 'login'])->name('institutes.login');
});


Route::resource('institutes', InstituteController::class)->only('edit', 'update', 'destroy')->middleware('institute');

///////End of Routs for Institute user


///////Routes for System Admin
Route::prefix('sysadmin')->group(function () {
    Route::middleware('sysadmin')->group(function () {


        Route::put('institute/password_change/{institute}', [InstituteController::class, 'password_change'])->name('sysadmin.institutes.password_change');
        Route::get('institute/password_change/{institute}/create', [InstituteController::class, 'password_change_create'])->name('sysadmin.institutes.password_change_create');

        Route::put('institute/email_change/{institute}', [InstituteController::class, 'email_change'])->name('sysadmin.institutes.email_change');
        Route::get('institute/email_change/{institute}/create', [InstituteController::class, 'email_change_create'])->name('sysadmin.institutes.email_change_create');



        Route::get('institute', [InstituteController::class, 'index'])->name('sysadmin.institutes.index');
        Route::get('institute/create', [InstituteController::class, 'create'])->name('sysadmin.institutes.create');
        Route::post('institute', [InstituteController::class, 'store'])->name('sysadmin.institutes.store');
        Route::get('institute/{institute}', [InstituteController::class, 'show'])->name('sysadmin.institutes.show');
        Route::put('institute/{institute}', [InstituteController::class, 'update'])->name('sysadmin.institutes.update');
        Route::delete('institute/{institute}', [InstituteController::class, 'destroy'])->name('sysadmin.institutes.destroy');
        Route::get('institute/{institute}/edit', [InstituteController::class, 'edit'])->name('sysadmin.institutes.edit');
    });
});

////////End of Routes for System Admin

/*------------------End Institute------------------------------------- */
