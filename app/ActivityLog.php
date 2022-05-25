<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    public function scopeName($query, $value)
    {
        if (!is_null($value))
            return $query->where('name', 'like', '%' . $value . '%');
    }

    public function scopePhone($query, $value)
    {
        if (!is_null($value))
            return $query->where('phone', 'like',  $value . '%');
    }

    public function scopeEmail($query, $value)
    {
        if (!is_null($value))
            return $query->where('email', 'like', $value . '%');
    }
}
