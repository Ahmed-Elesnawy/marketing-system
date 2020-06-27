<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechCard extends Model
{
    protected $fillable = [
        'title',
        'content',
        'closed_at',
        'reply',
        'user_id',
    ];

    /**
     * Model Relations
     * 
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Model Scopes
     * 
     */

    public function scopeOpendCards($query)
    {
        return $query->whereNull('closed_at');
    }

    public function scopeClosedCards($query)
    {
        return $query->whereNotNull('closed_at');
    }

    /**
     * Model Getters 
     */

    public function getIsClosedAttribute()

    {
        return !is_null($this->closed_at);
    }

    public function getIsOpendAttribute()

    {
        return !$this->is_closed;
    }
}
