<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function sector(){
        return $this->belongsTo('App\Models\Sector','sectorid');
    }

    public function state(){
        return $this->belongsTo('App\Models\State','stateid');
    }

    public function organisations(){
        return $this->hasMany('App\Models\Organisation','clientid');
    }

    public function departments(){
        return $this->hasMany('App\Models\Department','clientid');
    }

    public function users(){
        return $this->hasMany('App\Models\User','clientid');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

}
