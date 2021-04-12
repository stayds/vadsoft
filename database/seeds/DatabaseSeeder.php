<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(Sectorseeder::class);
       $this->call(Stateseeder::class);
       //$this->call(LicenceSeeder::class);
        //$this->call(ClientSeeder::class);
        $this->call(RoleSeeder::class);
        //$this->call(Organizationseeder::class);
        //$this->call(Userseeder::class);
        $this->call(Adminseeder::class);
        $this->call(Measuretypeseeder::class);
    }
}
