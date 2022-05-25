<?php

namespace App;

use App\UtilTraits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class ParameterValue extends Model
{
    use SoftDeletes, ModelTrait, LogsActivity;
    protected $fillable = [
        'name',
        'parameter_id',
        'description',
        'state'
    ];

    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        $activity->description = "Se ha " . __($eventName) . " el valor parametro " . $activity->subject->name;
    }

    public static function GetValue($id)
    {
        return ParameterValue::where('id', $id)->pluck('name')->first();
    }

    public static function GetByParameter($id)
    {
        return ParameterValue::where('parameter_id', $id)->get();
    }


    /*End logs config */

    public function parameter()
    {
        return $this->belongsTo(parameter::class);
    }
}
