<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
class LogOfRecharges extends Model
{
   use LogsActivity;
   protected $table = 'log_of_recharges';
   protected $primaryKey = 'id';
   protected $fillable = [
      'user_id',
      'reference',
      'state',
      'data'
   ];

   /* Logs Config */
   protected static $logFillable = true;
   protected static $submitEmptyLogs = false;

   public function tapActivity(Activity $activity, string $eventName)
   {
      $activity->log_name = __($eventName);
      $activity->description = "Se ha realizado un movimiento de recarga. REF: " . $activity->subject->reference;
   }
}
