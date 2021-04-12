<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    public function units(){
        return $this->hasMany('App\Models\Unit', 'deptid');
    }

    public function state(){
        return $this->belongsTo('App\Models\State','stateid');
    }

    public function organisation(){
        return $this->belongsTo('App\Models\Organisation','organisationid');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client','clientid');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User')
                    ->withPivot('receive','supervisor')
                    ->withTimestamps();

    }

    public function deptmeasures(){
        return $this->hasMany('App\Models\Deptmeasure','deptid');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
