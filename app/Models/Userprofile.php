<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Userprofile extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'userid','stateid','departmentid','jobtitle','fname', 'lname','profileimg','address','gradelevel','issupervisor','created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','userid');
    }

    public function department(){
        return $this->belongsTo('App\Models\State','departmentid');
    }

    public function state(){
        return $this->belongsTo('App\Models\State','stateid');
    }

    public function fullname(){
        return $this->fname.' '.$this->lname;
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }


}
