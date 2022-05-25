<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CustomerSubscription extends Model
{
    protected $guarded = [];
    protected $fillable = [];

    use Notifiable;
    use SoftDeletes;

    public function plan()
    {
        return $this->belongsTo(Subscription::class, 'subscription_plan_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


}
