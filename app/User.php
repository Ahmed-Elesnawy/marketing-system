<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password','type','commission','status','image','phone'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

    protected $appends = [
        'shipped_total_percent'
    ];

    /**
     * Models Getters 
     * 
     */

    
     public function getIsAdminAttribute()
     {
         return $this->type == 'admin';
     }


     public function getIsMarkterAttribute()
     {
         return $this->type == 'markter';
     }

     public function getShippedTotalPercentAttribute()
     {
        if ( !$this->is_admin and $this->orders->count() != 0 )
        {
            $percent = $this->orders()->shippedOrders()->get()->count() / $this->orders->count() * 100;
            return number_format($percent);
        }

        return 0;
     }


    /**
     * Model Relations
     * 
     */

     public function orders()
     {
        return $this->hasMany(Order::class);
     }

     public function moneyRequests()
     {
        return $this->hasMany(MoneyRequest::class);
     }

     public function techCards()
     {
         return $this->hasMany(TechCard::class);
     }

     public function messages()
     {
         return $this->hasMany(Message::Class);
     }


     /**
      * Model Scopes
      *
      */

      public function scopeAdmins($query)
      {
          return $query->where('type','admin');
      }

      public function scopeMarkters($query)
      {
          return $query->where('type','markter');
      }


    /**
     * Encrypt the password when inserted
     * 
     * @param mixed $value
     * @return void
     */

     
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }



     /**
      * Get Image Path 
      */

    public function getImagePathAttribute()
    {
        return url('storage/'.$this->image);
    }


    public function getHasMoneyRequestAttribute()
    {
        if ( $this->moneyRequests()->where('is_confirmed',0)->where('is_canceld',0)->exists() )
        {
            return true;
        }

        return false;
    }


    public function getTotalPorfitsAttribute()
    {
        return number_format($this->commission  + $this->moneyRequests()->confirmedRequests()
                              ->sum('money_needed'),2);
    }


    public function getPendingPorfitsAttribute()
    {
        $pending_porfits =  $this->orders()->where('shipping_status','!=','shipped')
                               ->whereNull('status')
                                ->sum('total_commission');

        

        return number_format($pending_porfits,2);
                                
        
    }

    
}
