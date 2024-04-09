<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Institute;
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

        Institute::factory(40)->create();

        Institute::factory()->create([
            'name'=>'Esoft',
            'email'=>'esoft@gmail.com',
            'address'=>'Colombo'
        ]);
        Institute::factory()->create([
            'name'=>'IDM',
            'email'=>'IDM@gmail.com',
            'address'=>'Negombo'
        ]);

    }
}
