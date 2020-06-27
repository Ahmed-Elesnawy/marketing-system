<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyRequest extends Model
{
    protected $fillable = [
        'phone',
        'money_needed',
        'note',
        'is_confirmed',
        'is_canceld',
        'canceld_at',
        'confirmed_at',
        'user_id'
    ];

    /**
     * Model Scopes
     * 
     */

    public function scopeConfirmedRequests($q)
    {
        return $q->whereNotNull('confirmed_at');
    }

    /**
     * Model Relations 
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Model Getters 
     * 
     */

    public function getIsPendingAttribute()
    {
        if ( $this->is_confirmed || $this->is_canceld )
        {
            return false;
        }
        return true;
    }


    
}
