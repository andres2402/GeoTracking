<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Role extends Model
{
   use SoftDeletes, LogsActivity;

   protected $table = 'roles';
   protected $primaryKey = 'id';
   protected $fillable = [
      'name',
      'unique',
      'state'
   ];

   /* Logs Config */
   protected static $logFillable = true;
   protected static $submitEmptyLogs = false;

   public function tapActivity(Activity $activity, string $eventName)
   {
      $activity->log_name = __($eventName);
      $activity->description = "Se ha " . __($eventName) . " el rol " . $activity->subject->name;
   }

   /*End logs config */
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
}
