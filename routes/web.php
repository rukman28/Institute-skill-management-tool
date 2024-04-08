<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SysadminController;
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


/*-----------------System Admin-----------------------------*/
Route::prefix('sysadmin')->group(function(){

Route::get('/login',[SysadminController::class,'index'])->name('sysadmin.login_form');
Route::post('/login/owner',[SysadminController::class,'login'])->name('sysadmin.login');
Route::get('/dashboard',[SysadminController::class,'dashboard'])->name('sysadmin.dashboard')->middleware('sysadmin');
Route::get('/logout',[SysadminController::class,'logout'])->name('sysadmin.logout')->middleware('sysadmin');

});



/*-----------------End System Admin-----------------------------*/

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
