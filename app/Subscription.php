<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Subscription extends Model
{
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'subscriptions_plans';

    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'price_by_day',
        'discount_value',
        'fk_user_id',
        'image_filename',
        'limit_offered_services',
        'limit_accepted_services',
        'limit_monthly_promos',
        'limit_shared_images',
        'limit_profile_updates',
        'location',
        'active'
    ];

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'LIKE', "%" . $name . "%");
        }
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
        $activity->description = "Se ha " . __($eventName) . " Suscripción " . $activity->subject->name;
    }
    /*End logs config */
}
