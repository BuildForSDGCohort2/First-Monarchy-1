<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
  protected $fillable = ['title','start','end','user_id'];
  // protected $dates = ['start','end'];
  public function visitable()
  {
    return $this->morphTo();
  }
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function getHumanDateAttribute():string
  {
    $dateA = \Carbon\Carbon::parse($this->start)->isoFormat('MMMM Do YYYY, h:mm a');
    $dateB = \Carbon\Carbon::parse($this->end)->isoFormat('h:mm a');
    return "$dateA to $dateB";
  }
}
