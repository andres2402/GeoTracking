<?php

namespace App;

use App\UtilTraits\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, ModelTrait, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 'code', 'code_confirmed', 'password', 'role_id', 'state'
    ];

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

    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        if($activity->causer){
            $activity->description = "Se ha " . __($eventName) . " el usuario " . $activity->subject->fullName;
        }
    }

    /*End logs config */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function scopeName($query, $value)
    {
        if (!is_null($value))
            return $query->where('name', 'like', '%' . $value . '%');
    }
    public function scopeState($query, $value)
    {
        if (!is_null($value))
            return $query->where('state', $value);
    }
    public function scopePhone($query, $value)
    {
        if (!is_null($value))
            return $query->where('phone', 'like',  $value . '%');
    }
    public function scopeRole($query, $value)
    {
        if (!is_null($value))
            return $query->where('role_id', $value);
    }
    public function scopeEmail($query, $value)
    {
        if (!is_null($value))
            return $query->where('email', 'like', $value . '%');
    }

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function getRoleAttribute()
    {
        return $this->getRole->name;
    }

    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->last_name;
    }
}
