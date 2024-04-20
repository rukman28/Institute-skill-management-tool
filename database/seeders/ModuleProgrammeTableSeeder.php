<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\Module;
use App\Models\Programme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleProgrammeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutes=Institute::all();
        $institutes->each(function($institute){

            $moduleCount=Module::where('institute_id',$institute->id)->count();
            if(0 === $moduleCount){
                $this->command->info('No Modules found, skipping assigning Modules to Programme');
                return;
            }

            Programme::where('institute_id',$institute->id)->each(function(Programme $programme) use($moduleCount,$institute) {
                $take=random_int(10,min(20,$moduleCount));
                $modules=Module::where('institute_id',$institute->id)->inRandomOrder()->take($take)->get()->pluck('id');
                $programme->modules()->sync($modules);
            });
        });


    }
}
