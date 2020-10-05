<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  public function images()
  {
    return $this->morphMany('App\Image' , 'imageable');
  }
  public function company()
  {
    return $this->belongsTo('App\Company');
  }
}
