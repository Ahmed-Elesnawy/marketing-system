<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'orderId',
        'total_price',
        'total_commission',
        'client_name',
        'client_address',
        'client_phone1',
        'client_phone2',
        'shipping_status',
        'shipping_number',
        'shipped_at',
        'discarded_at',
        'canceld_at',
        'markter_note',
        'status',
        'note',
        'canceld',
        'user_id',
        'province_id'
    ];

    protected $appends = [
        'is_alive',
    ];

    /**
     * Model Scopes
     * 
     */

     public function scopeShippedOrders($q)
     {
         return $q->where('shipping_status','shipped');
     }

     public function scopeDiscardedOrders($q)
     {
         return $q->where('status','discarded');
     }

     public function scopeCanceldOrders($q)
     {
         return $q->where('status','canceld');
     }


    /**
     * Model Relations
     * 
     */

     public function products()
     {
         return $this->belongsToMany(Product::class,'order_product')
                      ->withPivot([
                          'qty',
                          'price',
                          'commission',
                      ]);
     }

     public function province()
     {
         return $this->belongsTo(Province::class);
     }

     public function user()
     {
        return $this->belongsTo(User::class);
     }

     /**
      * Model Getters 
      *
      */
    
    public function getIsDiscardedAttribute()
    {
        return $this->status == 'discarded';
    }

    public function getIsCanceldAttribute()
    {
        return $this->status == 'canceld';
    }

    public function getIsAliveAttribute()
    {
        if ( $this->is_canceld || $this->is_discarded )
        {
            return false;
        }
        
        return true;
    }

    public function getIsPendingAttribute()
    {
        return $this->shipping_status == 'pending';
    }

    public function getIsShippedAttribute()
    {
        return $this->shipping_status == 'shipped';
    }

    public function getIsProcessingAttribute()
    {
        return $this->shipping_status == 'processing';
    }

    public function getPriceWithShippingAttribute()
    {
        return $this->total_price + $this->province->shipping_price;
    }
}
