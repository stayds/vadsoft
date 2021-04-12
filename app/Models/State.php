<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function departments(){
        return $this->hasMany('App\Models\Department','stateid');
    }

    public function organisation(){
        return $this->hasOne('App\Models\Organisation','stateid');
    }
}
