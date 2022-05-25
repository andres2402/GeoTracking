<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Permission extends Model
{
   use LogsActivity;
   protected $table = 'permissions';
   protected $primaryKey = 'id';
   protected $fillable = [
      'role_id',
      'action_id'
   ];

   /* Logs Config */
   protected static $logFillable = true;
   protected static $submitEmptyLogs = false;

   public function tapActivity(Activity $activity, string $eventName)
   {
      $activity->log_name = __($eventName);
      $activity->description = "Se ha " . __($eventName) . " el permiso " . $activity->subject->name;
   }

   /*End logs config */

   public function role()
   {
      return $this->belongsTo(Role::class, 'role_id');
   }

   public function action()
   {
      return $this->belongsTo(Action::class, 'action_id');
   }
}
