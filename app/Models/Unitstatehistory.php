<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unitstatehistory extends Model
{
    public function unitstate(){
        return $this->belongsTo('App\Models\Unitstate', 'unitstateid');
    }

    public function supervisor(){
        return $this->belongsTo('App\Models\User', 'supervisorid');
    }

}
