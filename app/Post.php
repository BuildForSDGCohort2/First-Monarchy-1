<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $with = ['images'];
  
    public function images()
    {
      return $this->morphMany('App\Image' , 'imageable');
    }
    public function company()
    {
      return $this->belongsTo('App\Company');
    }
    public function diaries()
    {
      return $this->morphedByMany('App\User','attachable');
    }
    public function tags()
    {
      return $this->morphedByMany('App\Tag','attachable');
    }
    public function addToDiary($post)
    {
      auth()->user()->diaryEntries()->attach($post);
    }
    public function removeFromDiary($post)
    {
      auth()->user()->diaryEntries()->detach($post);
    }
}
