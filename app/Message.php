<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
       
        'title',
        'body',
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
     * Model Getters 
     * 
     */

    public function getHasLongBodyAttribute()
    {
        return strlen($this->body) > 50;
    }


    public function getHasUserAttribute()
    {
        return !is_null($this->user_id);
    }
}
