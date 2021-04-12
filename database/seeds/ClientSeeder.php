<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Licence;
use App\Models\Sector;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $today = Carbon::now();
        $licence = Licence::first();
        $sector = Sector::first();
        DB::table('clients')->insert([
            'sectorid' => $sector->id,
            'name' => $faker->company,
            //'contact' => $faker->name,
            //'email' => $faker->companyEmail,
            //'phone' => '08058679087',
            'licenceid' => $licence->id,
            'address' => $faker->address,
            'stateid' => 2,
            'organ'=> 30,
            'status' => true,
            'expiry_date'=> $today->addYears(3),
            'created_at' => $today,
            'updated_at' => $today
        ]);
    }
}
