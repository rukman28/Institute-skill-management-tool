<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Institute;
use App\Models\Module;
use App\Models\Practical;
use App\Models\Programme;
use App\Models\Skill;
use App\Models\Skillcategory;
use App\Models\Sysadmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        User::factory()->create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
        ]);


        Sysadmin::factory(3)->create();

        Sysadmin::factory()->create([
            'name'=>'sysadmin',
            'email'=>'sysadmin@gmail.com'
        ]);

        $inst=Institute::factory()->create([
            'name'=>'IDM',
            'email'=>'idm@gmail.com',
        ]);

        $institutes=Institute::factory(5)->create();
        $institutes->push($inst);

        foreach($institutes as $institute){
            Skillcategory::factory()
            ->count(10)
            ->for($institute)
            ->create()->each(function(Skillcategory $skillcategory)use($institute){

                Skill::factory(10)->create([
                    'institute_id'=>$institute->id,
                    'skillcategory_id'=>$skillcategory->id,
                ]);
            });

            Programme::factory()
            ->count(20)
            ->for($institute)
            ->create();

            Module::factory()
            ->count(40)
            ->for($institute)
            ->create();

            Practical::factory()
            ->count(50)
            ->for($institute)
            ->create();
        }


        $this->call([
            ModuleProgrammeTableSeeder::class,
            ModulePracticalTableSeeder::class,
            PracticalSkillTableSeeder::class,
        ]);




    }
}

