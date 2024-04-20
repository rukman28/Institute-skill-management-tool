<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\Module;
use App\Models\Practical;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulePracticalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutes=Institute::all();
        $institutes->each(function($institute){

            $practicalCount=Practical::where('institute_id',$institute->id)->count();
            if(0 === $practicalCount){
                $this->command->info('No Practicals found, skipping assigning Practicals to Module');
                return;
            }

            Module::where('institute_id',$institute->id)->each(function(Module $module) use($practicalCount,$institute) {
                $take=random_int(10,min(20,$practicalCount));
                $practicals=Practical::where('institute_id',$institute->id)->inRandomOrder()->take($take)->get()->pluck('id');
                $module->practicals()->sync($practicals);
            });
        });

    }
}
