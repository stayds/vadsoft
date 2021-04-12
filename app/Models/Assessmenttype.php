<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Assessmenttype extends Model
{
    public function staffmeasures(){
        return $this->hasMany('App\Models\Staffmeasure','assessid');
    }

    public function unitmeasures(){
        return $this->hasMany('App\Models\Unitmeasures','assessid');
    }

    public function deptmeasures(){
        return $this->hasMany('App\Models\Deptmeasure','assessid');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

}
