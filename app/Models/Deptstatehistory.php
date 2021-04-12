<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deptstatehistory extends Model
{
    public function deptstate(){
        return $this->belongsTo('App\Models\Deptstate','deptstateid');
    }

    public function supervisor(){
        return $this->belongsTo('App\Models\User','supervisorid');
    }

}
