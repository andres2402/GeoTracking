<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderMedia extends Model
{
    //
    use SoftDeletes;

    protected $fillable= [ 
        'fk_slider_id',
        'filename',
        'path',
        'url',
        'format',
        'width',
        'height',
        'size'
    ];
}
