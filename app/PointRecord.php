<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'day',
        'beginning_day',
        'out_lunch',
        'back_lunch',
        'end_day',
    ];

    protected $dates = [
        'day'
    ];


    public function user()
    {
        return $this->hasOne('App\User');
    }
}
