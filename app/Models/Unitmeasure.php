<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unitmeasure extends Model
{
    public function unitstates(){
        return $this->hasMany('App\Models\Unitstate', 'measureid');
    }

    public function users(){
        return $this->belongsTo('App\Models\User', 'userid');
    }

    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'unitid');
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
