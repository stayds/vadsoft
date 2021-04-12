<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name','email','phone','clientid','organid','roleid','status','isdev','password','created_at','updated_at'
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userprofile(){
        return $this->hasOne('App\Models\Userprofile', 'userid');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client','clientid');
    }

    public function organisation(){
        return $this->belongsTo('App\Models\Organisation', 'organid');
    }

    public function staffstates(){
        return $this->hasMany('App\Models\Staffstate', 'userid');
    }

    public function units(){
        return $this->belongsToMany('App\Models\Unit')
            ->withPivot('receive')
            ->withTimestamps();
    }

    public function departments(){
        return $this->belongsToMany('App\Models\Department')
            ->withPivot('supervisor','receive')
            ->withTimestamps();
    }

    public function role(){
        return $this->belongsTo('App\Models\Role','roleid');
    }

    public function unitstates(){
        return $this->hasMany('App\Models\Unitstate','userid');
    }

    public function deptstates(){
        return $this->hasMany('App\Models\Deptstate','userid');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }


}
