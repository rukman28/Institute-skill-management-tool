<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModulePracticalController;
use App\Http\Controllers\ModuleProgrammeController;
use App\Http\Controllers\PracticalController;
use App\Http\Controllers\PracticalSkillController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SkillcategoryController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProgrammeUserController;

use Illuminate\Support\Facades\Route;




Route::middleware('institute')->group(function () {


    /*----------------------Programme Routes---------------------------------- */

    Route::resource('programmes', ProgrammeController::class)->only('index', 'destroy', 'create', 'store', 'show');
    /*----------------------End of Programme Routes---------------------------------- */


    /*----------------------Module Routes---------------------------------- */

    Route::resource('modules', ModuleController::class)->only('index', 'destroy', 'create', 'store');


    /*----------------------End of Module Routes---------------------------------- */


    /*----------------------Practical Routes---------------------------------- */

    Route::resource('practicals', PracticalController::class)->only('index', 'destroy', 'create', 'store');


    /*----------------------End of Practical Routes---------------------------------- */


    /*----------------------Skill Routes---------------------------------- */

    Route::resource('skills', SkillController::class)->only('index', 'destroy', 'create', 'store', 'show');
    Route::get('skills/{skill}/skillcategory', [SkillController::class, 'indexSkillcategory'])->name('indexSkillcategory.index');


    /*----------------------End of Skill Routes---------------------------------- */


    /*----------------------Skillcategory Routes---------------------------------- */

    Route::resource('skillcategories', SkillcategoryController::class)->only('index', 'destroy', 'create', 'store', 'show');


    /*----------------------End of Skillcategory Routes---------------------------------- */


    // Route::resource('module_programmes',ModuleProgrammeController::class)->only('show');

    Route::scopeBindings()->group(function () {
        Route::get('programmes/module_programmes/{programme}/module', [ModuleProgrammeController::class, 'indexModules'])->name('module_programmes.index'); // Find Modules for a Programme
        Route::get('modules/module_programmes/{module}/programme', [ModuleProgrammeController::class, 'indexProgrammes'])->name('module_programmes.module'); // Find programmes for a module
        Route::delete('module_programmes/{programme}/modules/{module}', [ModuleProgrammeController::class, 'destroy'])->name('module_programmes.destroy');
        Route::get('programmes/module_programmes/{programme}/modules/create', [ModuleProgrammeController::class, 'create'])->name('module_programmes.create');
        Route::post('programmes/module_programmes/{programme}/modules/store', [ModuleProgrammeController::class, 'store'])->name('module_programmes.store');



        Route::get('modules/module_practicals/{module}/practical', [ModulePracticalController::class, 'indexPracticals'])->name('module_practicals.index'); //Find Practicals for a Module
        Route::get('practicals/module_practicals/{practical}/module', [ModulePracticalController::class, 'indexModules'])->name('module_practicals.practical'); //Find Modules for a Practical
        Route::delete('module_practicals/{module}/practicals/{practical}', [ModulePracticalController::class, 'destroy'])->name('module_practicals.destroy');
        Route::get('modules/module_practicals/{module}/practicals/create', [ModulePracticalController::class, 'create'])->name('module_practicals.create');
        Route::post('module_practicals/{module}/practicals/store', [ModulePracticalController::class, 'store'])->name('module_practicals.store');

        Route::get('practicals/practical_skills/{practical}/skill', [PracticalSkillController::class, 'index'])->name('practical_skills.index'); //Find Skills per Practical
        Route::get('skills/practical_skills/{skill}/practical', [PracticalSkillController::class, 'indexPracticals'])->name('practical_skills.skill'); //Find Practicals per Skill
        Route::delete('practical_skills/{practical}/skills/{skill}', [PracticalSkillController::class, 'destroy'])->name('practical_skills.destroy');
        Route::get('practical_skills/{practical}/skills/create', [PracticalSkillController::class, 'create'])->name('practical_skills.create');
        Route::post('practical_skills/{practical}/skills/store', [PracticalSkillController::class, 'store'])->name('practical_skills.store');
    });


    ///////////////////////////// ProgrammeUserController ///////////////////////////////////////

    Route::get('institutes/find_user', [ProgrammeUserController::class, 'find_user_create'])->name('find.user.create');
    Route::post('institutes/show_user', [ProgrammeUserController::class, 'find_user'])->name('find.user');
    Route::post('institutes/programmes/user/{user}/store', [ProgrammeUserController::class, 'store'])->name('user.store');
});
