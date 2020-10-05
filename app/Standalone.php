<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Standalone extends Model implements ViewableContract
{
  use Viewable;

   protected $fillable =['name','description','bedrooms','bathrooms','parking_slots','location','area','selling_price','plot_size','coverImage','year_built'];

   protected $with = ['ratings'];
   
    public function images()
    {
      return $this->morphMany('App\Image' , 'imageable');
    }
    public function visits()
    {
      return $this->morphMany('App\Visit' , 'visitable');
    }
    public function ratings()
    {
      return $this->morphMany('App\Rating' , 'rateable');
    }
    public function standaloneable()
    {
      return $this->morphTo();
    }
    public function community()
    {
      return $this->belongsTo('App\Community');
    }
    public function likes()
    {
      return $this->morphToMany('App\User' , 'likeable');
    }
    public function addToFavourites($standalone)
    {
      auth()->user()->favourite_standalones()->attach($standalone);
    }
    public function removeFromFavourites($standalone)
    {
      auth()->user()->favourite_standalones()->detach($standalone);
    }
}
