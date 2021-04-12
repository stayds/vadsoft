<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staffmeasure extends Model
{
    public function staffstates(){
        return $this->hasMany('App\Models\Staffstate', 'measureid');
    }

    public function users(){
        return $this->belongsTo('App\Models\User', 'userid');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department', 'deptid');
    }

    public function organisation(){
        return $this->belongsTo('App\Models\Organisation', 'organid');
    }

    public function assessment(){
        return $this->belongsTo('App\Models\Assessmenttype', 'assessid');
    }
    public function kpi(){
        return $this->belongsTo('App\Models\Kpi', 'kpiid');
    }

}
