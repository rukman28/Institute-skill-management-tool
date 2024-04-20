<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\Practical;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticalSkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ //practical skill
    public function run(): void
    {
        $institutes=Institute::all();
        $institutes->each(function($institute){

            $skillCount=Skill::where('institute_id',$institute->id)->count();
            if(0 === $skillCount){
                $this->command->info('No Skills found, skipping assigning Skills to Practical');
                return;
            }

            Practical::where('institute_id',$institute->id)->each(function(Practical $practical) use($skillCount,$institute) {
                $take=random_int(5,min(15,$skillCount));
                $skills=Skill::where('institute_id',$institute->id)->inRandomOrder()->take($take)->get()->pluck('id');
                $practical->skills()->sync($skills);
            });
        });


    }
}
