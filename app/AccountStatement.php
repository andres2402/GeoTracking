<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class AccountStatement extends Model
{
   use SoftDeletes, LogsActivity;

   protected $table = 'account_statements';
   protected $primaryKey = 'id';
   protected $fillable = [
      'user_id',
      'name',
      'previous_value',
      'value',
      'total',
      'type',
      'state'
   ];

   /* Logs Config */
   protected static $logFillable = true;
   protected static $submitEmptyLogs = false;

   public function tapActivity(Activity $activity, string $eventName)
   {
      $activity->log_name = __($eventName);
      $activity->description = "Se ha " . __($eventName) . " un movimiento en el estado de cuenta (" . $activity->subject->name . ")";
   }
}
