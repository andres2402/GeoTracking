<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Action extends Model
{
   use SoftDeletes, LogsActivity;

   protected $table = 'actions';
   protected $primaryKey = 'id';
   protected $fillable = [
      'module_id',
      'name',
      'reference',
      'route',
      'parent',
      'state'
   ];
   /* Logs Config */

   protected static $logFillable = true;
   protected static $submitEmptyLogs = false;

   public function tapActivity(Activity $activity, string $eventName)
   {
      $activity->log_name = __($eventName);
      $activity->description = "Se ha " . __($eventName) . " la acción " . $activity->subject->name;
   }
   /*End logs config */

   public function module()
   {
      return $this->belongsTo(parameter::class, 'module_id');
   }

   public function getParent()
   {
      return $this->belongsTo(Action::class, 'parent');
   }
}
