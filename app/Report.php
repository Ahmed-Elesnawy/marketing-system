<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [

        'from',
        'to',
        'total_orders',
        'shipped_orders',
        'canceld_orders',
        'discarded_orders',
        'money_requested',
        'total_porfits',
        'shipped_to_total',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getHasUserAttribute()
    {
        return !is_null($this->user_id);
    }
}
