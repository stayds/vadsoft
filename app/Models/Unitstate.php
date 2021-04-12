<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unitstate extends Model
{

    public function unitmeasure(){
        return $this->belongsTo('App\Models\Unitmeasure', 'measureid');
    }
    public function unitstatehistories(){
        return $this->hasMany('App\Models\Unitstatehistory','unitstateid');
    }
}
