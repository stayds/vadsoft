<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Departmentseeder extends Seeder
{

    public function run()
    {
        $department = ["IT","Marketing"];
        $faker = Faker::create();
        foreach ( $department as $list){
            DB::table('departments')->insert(
                [
                    'organisationid'=>1,
                    'name' => $list,
                    'description'=>"This is just a test for a department",
                    'stateid'=>2,
                    'address'=>$faker->address,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
