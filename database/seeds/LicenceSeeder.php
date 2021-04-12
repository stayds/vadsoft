<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LicenceSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        DB::table('licences')->insert([
            'code' => $faker->bankAccountNumber,
            'duration' => 3,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
    }
}
