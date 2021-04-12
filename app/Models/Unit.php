<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function department(){
        return $this->belongsTo('App\Models\Department', 'deptid');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User')
                    ->withPivot('receive')
                    ->withTimestamps();
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

}
