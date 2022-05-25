<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{
    //
    use Notifiable, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'active',
        'fk_slider_type_id'
    ];

    public function Media()
    {
        return $this->hasMany('App\SliderMedia', 'fk_slider_id');
    }

    public function MediaApi()
    {
        return $this->hasMany('App\SliderMedia', 'fk_slider_id')->select(['fk_slider_id', 'path']);
    }

    public function scopeActive($query, $active)
    {
        if ($active) {
            return $query->where('active', $active);
        }
    }


    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        $activity->description = "Se ha " . __($eventName) . " Slider ". $activity->subject->name;
    }
    /*End logs config */
}
