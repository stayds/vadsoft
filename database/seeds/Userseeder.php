<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $date = Carbon::now();
        DB::table('users')->insert([
            'name' => $faker->firstName,
            'password'=> Hash::make('password@1'),
            'email' => 'dev@vadsoft.com',
            'phone' => '09011111111',
            'email_verified_at'=> $date,
            'clientid'=>1,
            'roleid'=>1,
            'organid'=>1,
            'isdev'=>true,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('userprofiles')->insert([
            'userid' => 1,
            'staffno'=>10000,
            'fname' => 'Scarlett',
            'lname' => $faker->lastname,
            'jobtitle'=>'Manager',
            'jobdesc'=>'Managing things',
            'gender'=>'Male',
            'gradelevel'=>'5 level 6',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
