<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use App\Models\Client;

class Organizationseeder extends Seeder
{

    public function run()
    {

        $client = Client::first();
        DB::table('organisations')->insert([
            'sectorid' => $client->sectorid,
            'name' => $client->name,
            //'contact'=> $client->contact,
            //'email' => $client->email,
            //'phone' => $client->phone,
            'address'=>$client->address,
            'clientid'=>$client->id,
            'stateid'=>$client->stateid,
            'status'=>true,
            'parent'=>true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
