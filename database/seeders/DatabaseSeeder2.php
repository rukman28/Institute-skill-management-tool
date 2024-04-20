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
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
        ]);


        Sysadmin::factory(10)->create();

        Sysadmin::factory()->create([
            'name'=>'sysadmin',
            'email'=>'sysadmin@gmail.com'
        ]);

        /*----------------------------------Institute with Programme------------------------------------- */
        Institute::factory(10)->create()->each(function($institute){

            $num=random_int(5,30);
            Programme::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Module::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Practical::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Skillcategory::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Skill::factory()->count($num)
            ->for($institute)
            ->create();

        });

        Institute::factory()->create([
            'name'=>'Esoft',
            'email'=>'esoft@gmail.com',
            'address'=>'Colombo'
        ])->each(function($institute){
            $num=random_int(5,30);
            Programme::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Module::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Practical::factory()->count($num)
            ->for($institute)
            ->create();



            $num=random_int(5,30);
            Skillcategory::factory()->count($num)
            ->for($institute)
            ->create();



            $num=random_int(5,30);
            Skill::factory()->count($num)
            ->for($institute)
            ->create();



        });


        Institute::factory()->create([
            'name'=>'IDM',
            'email'=>'IDM@gmail.com',
            'address'=>'Negombo'
        ])->each(function($institute){
            $num=random_int(5,30);

            Programme::factory()->count($num)
            ->for($institute)
            ->create();

            Programme::factory()
            ->for($institute)
            ->create([
                'name'=>'Computer'
            ]);

            $num=random_int(5,30);
            Module::factory()->count($num)
            ->for($institute)
            ->create();

            $num=random_int(5,30);
            Practical::factory()->count($num)
            ->for($institute)
            ->create();



            $num=random_int(5,30);
            Skillcategory::factory()->count($num)
            ->for($institute)
            ->create();



            $num=random_int(5,30);
            Skill::factory()->count($num)
            ->for($institute)
            ->create();




        });


        $this->call([
            ModuleProgrammeTableSeeder::class,
            ModulePracticalTableSeeder::class,
            PracticalSkillTableSeeder::class,
        ]);


/*----------------------------------End of Institute with Programme------------------------------------- */


    }
}
