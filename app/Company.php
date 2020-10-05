<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
  use Notifiable;

  protected $guard = 'company';

  protected $fillable = [
      'name' , 'bio' , 'email' ,'logo' ,'phone','address','type', 'password',
  ];
  protected $hidden = [
      'password', 'remember_token',
  ];
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];
  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }
  public function ratings()
  {
    return $this->morphMany('App\Rating' , 'rateable');
  }
  public function posts()
  {
    return $this->hasMany('App\Post');
  }
  public function projects()
  {
    return $this->hasMany('App\Project');
  }
}
