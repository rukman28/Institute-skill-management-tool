<?php

use App\Http\Controllers\InstituteController;
use App\Http\Controllers\InstituteGuardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModulePracticalController;
use App\Http\Controllers\ModuleProgrammeController;
use App\Http\Controllers\PracticalController;
use App\Http\Controllers\PracticalSkillController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ProgrammeModuleController;
use App\Http\Controllers\SkillcategoryController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SysadminController;
use App\Http\Controllers\ProgrammeUserController;
use App\Models\Module;
use App\Models\Practical;
use App\Models\Programme;
use App\Models\Skill;
use App\Models\Skillcategory;
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



/*-------------------------------------------Institute------------------------------------- */

/////////Routes for Institute user
Route::prefix('institutes')->group(function(){
Route::middleware('institute')->group(function(){


Route::put('{institute}/edit/password_change',[InstituteController::class,'password_change'])->name('institutes.password_change');
Route::get('{institute}/edit/password_change/create',[InstituteController::class,'password_change_create'])->name('institutes.password_change_create');

Route::put('{institute}/edit/email_change',[InstituteController::class,'email_change'])->name('institutes.email_change');
 Route::get('{institute}/edit/email_change/create',[InstituteController::class,'email_change_create'])->name('institutes.email_change_create');

 Route::get('dashboard',[InstituteGuardController::class,'dashboard'])->name('institutes.dashboard');
 Route::get('logout',[InstituteGuardController::class,'logout'])->name('institutes.logout');

});

Route::get('login',[InstituteGuardController::class,'index'])->name('institutes.login_form');
Route::post('login/owner',[InstituteGuardController::class,'login'])->name('institutes.login');

});


Route::resource('institutes',InstituteController::class)->only('edit','update','destroy')->middleware('institute');

///////End of Routs for Institute user



///////Routes for System Admin
Route::prefix('sysadmin')->group(function(){
Route::middleware('sysadmin')->group(function(){


    Route::put('institute/password_change/{institute}',[InstituteController::class,'password_change'])->name('sysadmin.institutes.password_change');
    Route::get('institute/password_change/{institute}/create',[InstituteController::class,'password_change_create'])->name('sysadmin.institutes.password_change_create');

    Route::put('institute/email_change/{institute}',[InstituteController::class,'email_change'])->name('sysadmin.institutes.email_change');
    Route::get('institute/email_change/{institute}/create',[InstituteController::class,'email_change_create'])->name('sysadmin.institutes.email_change_create');



    Route::get('institute',[InstituteController::class,'index'])->name('sysadmin.institutes.index');
    Route::get('institute/create',[InstituteController::class,'create'])->name('sysadmin.institutes.create');
    Route::post('institute',[InstituteController::class,'store'])->name('sysadmin.institutes.store');
    Route::get('institute/{institute}',[InstituteController::class,'show'])->name('sysadmin.institutes.show');
    Route::put('institute/{institute}',[InstituteController::class,'update'])->name('sysadmin.institutes.update');
    Route::delete('institute/{institute}',[InstituteController::class,'destroy'])->name('sysadmin.institutes.destroy');
    Route::get('institute/{institute}/edit',[InstituteController::class,'edit'])->name('sysadmin.institutes.edit');
});
});

////////End of Routes for System Admin

/*------------------End Institute------------------------------------- */




Route::middleware('institute')->group(function(){


/*----------------------Programme Routes---------------------------------- */

Route::resource('programmes',ProgrammeController::class)->only('index','destroy','create','store','show');
/*----------------------End of Programme Routes---------------------------------- */


/*----------------------Module Routes---------------------------------- */

Route::resource('modules',ModuleController::class)->only('index','destroy','create','store');


/*----------------------End of Module Routes---------------------------------- */


/*----------------------Practical Routes---------------------------------- */

Route::resource('practicals',PracticalController::class)->only('index','destroy','create','store');


/*----------------------End of Practical Routes---------------------------------- */


/*----------------------Skill Routes---------------------------------- */

Route::resource('skills',SkillController::class)->only('index','destroy','create','store','show');
Route::get('skills/{skill}/skillcategory',[SkillController::class,'indexSkillcategory'])->name('indexSkillcategory.index');


/*----------------------End of Skill Routes---------------------------------- */


/*----------------------Skillcategory Routes---------------------------------- */

Route::resource('skillcategories',SkillcategoryController::class)->only('index','destroy','create','store','show');


/*----------------------End of Skillcategory Routes---------------------------------- */


// Route::resource('module_programmes',ModuleProgrammeController::class)->only('show');

Route::scopeBindings()->group(function(){
    Route::get('programmes/module_programmes/{programme}/module',[ModuleProgrammeController::class,'indexModules'])->name('module_programmes.index'); // Find Modules for a Programme
    Route::get('modules/module_programmes/{module}/programme',[ModuleProgrammeController::class,'indexProgrammes'])->name('module_programmes.module'); // Find programmes for a module
    Route::delete('module_programmes/{programme}/modules/{module}',[ModuleProgrammeController::class,'destroy'])->name('module_programmes.destroy');
    Route::get('programmes/module_programmes/{programme}/modules/create',[ModuleProgrammeController::class,'create'])->name('module_programmes.create');
    Route::post('programmes/module_programmes/{programme}/modules/store',[ModuleProgrammeController::class,'store'])->name('module_programmes.store');



    Route::get('modules/module_practicals/{module}/practical',[ModulePracticalController::class,'indexPracticals'])->name('module_practicals.index');//Find Practicals for a Module
    Route::get('practicals/module_practicals/{practical}/module',[ModulePracticalController::class,'indexModules'])->name('module_practicals.practical'); //Find Modules for a Practical
    Route::delete('module_practicals/{module}/practicals/{practical}',[ModulePracticalController::class,'destroy'])->name('module_practicals.destroy');
    Route::get('modules/module_practicals/{module}/practicals/create',[ModulePracticalController::class,'create'])->name('module_practicals.create');
    Route::post('module_practicals/{module}/practicals/store',[ModulePracticalController::class,'store'])->name('module_practicals.store');

    Route::get('practicals/practical_skills/{practical}/skill',[PracticalSkillController::class,'index'])->name('practical_skills.index');//Find Skills per Practical
    Route::get('skills/practical_skills/{skill}/practical',[PracticalSkillController::class,'indexPracticals'])->name('practical_skills.skill'); //Find Practicals per Skill
    Route::delete('practical_skills/{practical}/skills/{skill}',[PracticalSkillController::class,'destroy'])->name('practical_skills.destroy');
    Route::get('practical_skills/{practical}/skills/create',[PracticalSkillController::class,'create'])->name('practical_skills.create');
    Route::post('practical_skills/{practical}/skills/store',[PracticalSkillController::class,'store'])->name('practical_skills.store');

});


///////////////////////////// ProgrammeUserController ///////////////////////////////////////

Route::get('institutes/find_user',[ProgrammeUserController::class,'find_user_create'])->name('find.user.create');
Route::post('institutes/show_user',[ProgrammeUserController::class,'find_user'])->name('find.user');
Route::post('institutes/programmes/user/{user}/store',[ProgrammeUserController::class,'store'])->name('user.store');

});


Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
