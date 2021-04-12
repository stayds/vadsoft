<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    public $timestamps = true;

    public function getFormattedDateAttribute()
    {               
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

}
