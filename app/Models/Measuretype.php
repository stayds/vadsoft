<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measuretype extends Model
{
    public function staffstates(){
        return $this->hasMany('App\Models\Staffstate', 'measuretypeid');
    }
    public function deptstates(){
        return $this->hasMany('App\Models\Deptstate','measuretypeid');
    }
    public function unitstates(){
        return $this->hasMany('App\Models\Unitstate','measuretypeid');
    }
}
