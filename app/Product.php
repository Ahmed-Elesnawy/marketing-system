<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'price',
        'commission',
        'stock',
        'category_id',
        'desc',
        'image',
        'images_url',
        'sizes',
    ];
    
    /**
     * Product Model Relations
     */

     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function colors()
     {
         return $this->belongsToMany(Color::class,'product_color');
     }

     


     /**
      * Get Attributes 
      *
      */

      public function getImagePathAttribute()
      {
        return url('storage/'.$this->image);
      }

      public function getLimitedDescAttribute()
      {
          return Str::limit($this->desc,50);
      }

      public function getHasColorsAttribute()
      {
          return $this->colors->count() != 0 ? true : false;
      }

      public function getSizesAttribute($value)
      {
          if ( is_null($value) || empty($value) )
          {
              return null;
          }

          return explode(',',$value);
      }

      public function getHasSizesAttribute()
      {
          return !is_null($this->sizes);
      }
}
