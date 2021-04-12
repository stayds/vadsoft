<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    public function deptmeasures(){
        return $this->hasMany('App\Models\Deptmeasure','kpiid');
    }
    public function staffmeasures(){
        return $this->hasMany('App\Models\Staffmeasure','kpiid');
    }
    public function unitmeasures(){
        return $this->hasMany('App\Models\Unitmeasure','kpiid');
    }
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
