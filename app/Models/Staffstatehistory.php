<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staffstatehistory extends Model
{
    public function staffstate(){
        return $this->belongsTo('App\Models\Staffstate','staffstateid');
    }

    public function supervisor(){
        return $this->belongsTo('App\Models\User','supervisorid');
    }
}
