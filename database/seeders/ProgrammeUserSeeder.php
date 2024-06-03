<?php

namespace Database\Seeders;

use App\Models\Programme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=User::all();
        $users->each(function($user){
            $programmeCount=Programme::count();
            if(!$programmeCount){
                $this->command->info('No Programmes found, skipping assigning Programmes to User');
                return;
            }else{
                $take=random_int(1,6);
                $programmes=Programme::inRandomOrder()->take($take)->get();
                foreach($programmes as $programme){
                    $user->programmes()->attach($programme,['institute_id'=>$programme->institute_id]);
                }
            }
        });

    }
}
