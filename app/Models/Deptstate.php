<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deptstate extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User', 'userid');
    }
    public function deptmeasure(){
        return $this->belongsTo('App\Models\Deptmeasure', 'measureid');
    }
    public function deptstatehistories(){
        return $this->hasMany('App\Models\Deptstatehistory','deptstateid');
    }
    public function kpi(){
        return $this->belongsTo('App\Models\Kpi','kpiid');
    }
    public function assessmentype(){
        return $this->belongsTo('App\Models\Assessmenttype','assessid');
    }
    public function department(){
        return $this->belongsTo('App\Models\Department','deptid');
    }

}
