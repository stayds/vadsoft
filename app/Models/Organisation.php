<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{

    public function sector(){
        return $this->belongsTo('App\Models\Sector','sectorid');
    }

    public function state(){
        return $this->belongsTo('App\Models\State','stateid');
    }

    public function departments(){
        return $this->hasMany('App\Models\Department','organisationid');
    }

    public function users(){
        return $this->hasMany('App\Models\User','organid');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client','clientid');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

}
