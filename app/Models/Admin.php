<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Notifications\AdminResetNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'adminweb';

    protected $fillable = [
        'fname','lname', 'email', 'password','status','phone', 'roleid'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function adminrole(){
        return $this->hasOne('App\Models\Admin_role','adminid');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetNotification($token));
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    /****
    public function hasRoles($roles){
    return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role){
    return null !== $this->roles()->where('name', $role)->first();
    }

    public function roles(){
    return $this->belongsToMany('App\Models\Role', 'admin_role', 'adminid', 'roleid')
    ->withPivot('status')
    ->withTimestamps();
    }
     * ***/


}
