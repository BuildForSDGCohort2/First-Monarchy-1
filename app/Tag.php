<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
      'name','origin'
    ];

    public function posts()
    {
      return $this->morphToMany('App\Post','attachable');
    }
}
