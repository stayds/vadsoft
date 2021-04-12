<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function organisations(){
        return $this->hasMany('App\Models\Organisation','sectorid');
    }

    public function clients(){
        return $this->hasMany('App\Models\Client','sectorid');

    }

}
