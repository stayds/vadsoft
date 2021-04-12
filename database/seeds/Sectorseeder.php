<?php

use Illuminate\Database\Seeder;

class Sectorseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = ["Banking","Clothing","Finance","Information Technology","Insurance","Public Service","Religious Organisation"];
        foreach ( $sectors as $list){
            DB::table('sectors')->insert(
                ['name' => $list]
            );
        }
    }
}
