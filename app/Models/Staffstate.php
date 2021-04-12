<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staffstate extends Model
{
    public function staffmeasure(){
        return $this->belongsTo('App\Models\Staffmeasure', 'measuretype');
    }
    public function staffstatehistories(){
        return $this->hasMany('App\Models\Staffstatehistory','staffstateid');
    }
}
