<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Module extends Model
{
   use SoftDeletes, LogsActivity;

   protected $table = 'modules';
   protected $primaryKey = 'id';
   protected $fillable = [
      'name',
      'reference',
      'parent',
      'visible',
      'state'
   ];

   /* Logs Config */
   protected static $logFillable = true;
   protected static $submitEmptyLogs = false;

   public function tapActivity(Activity $activity, string $eventName)
   {
      $activity->log_name = __($eventName);
      $activity->description = "Se ha " . __($eventName) . " el módulo " . $activity->subject->name;
   }

   public function actions()
   {
      return $this->hasMany(Action::class, 'module_id');
   }
}
