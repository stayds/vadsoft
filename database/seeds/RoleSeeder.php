<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{

    public function run()
    {
        $role = ["Admin","Super Admin","Super Viewer","Basic"];

        foreach ( $role as $list) {
            DB::table('roles')->insert(
                [
                    'name' => $list,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
