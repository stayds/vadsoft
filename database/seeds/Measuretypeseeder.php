<?php

use Illuminate\Database\Seeder;

class Measuretypeseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = ["efficiency","effectiveness"];
        foreach ( $sectors as $list){
            DB::table('measuretypes')->insert(
                ['name' => $list]
            );
        }
    }
}
