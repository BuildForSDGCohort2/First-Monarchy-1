<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Community extends Model implements ViewableContract
{
  use Viewable;

    protected $fillable = ['name','description','location','coverImage'];
    public function images()
    {
      return $this->morphMany('App\Image' , 'imageable');
    }
    public function communityable()
    {
      return $this->morphTo();
    }
    public function rentals()
    {
      return $this->hasMany('App\Rental');
    }
    public function hostels()
    {
      return $this->hasMany('App\Hostel');
    }
    public function standalones()
    {
      return $this->hasMany('App\Standalone');
    }
    public function workspaces()
    {
      return $this->hasMany('App\Workspace');
    }
    public function likes()
    {
      return $this->morphToMany('App\User' , 'likeable');
    }
    public function addToFavourites($community)
    {
      auth()->user()->favourite_communities()->attach($community);
    }
    public function removeFromFavourites($community)
    {
      auth()->user()->favourite_communities()->detach($community);
    }
}
