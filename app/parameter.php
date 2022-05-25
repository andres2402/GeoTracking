<?php

namespace App;

use App\UtilTraits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class parameter extends Model
{
    use SoftDeletes, ModelTrait, LogsActivity;

    protected $fillable = [
        'name',
        'description',
        'extra',
        'state'
    ];

    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        $activity->description = "Se ha " . __($eventName) . " el parametro " . $activity->subject->name;
    }

    /*End logs config */

    public function parametersValues()
    {
        return $this->hasMany(ParameterValue::class);
    }
}
