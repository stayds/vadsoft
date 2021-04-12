<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Faker::create();
        $date = Carbon::now();
        DB::table('admins')->insert([
            'fname' => 'admin',
            'lname' => 'vadsoft',
            'password'=> Hash::make('Password@1'),
            'email' => 'dev@vadsoft.com',
            'phone' => '09011111111',
            'email_verified_at'=> $date,
            'created_at' => $date,
            'updated_at' => $date
    ]);
    }
}
