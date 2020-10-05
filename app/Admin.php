<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
  use Notifiable;

      protected $appends = [
        'name'
      ];

      protected $guard = 'admin';

      protected $fillable = [
          'first_name' , 'last_name' , 'email' ,'avatar' , 'password',
      ];
      protected $hidden = [
          'password', 'remember_token',
      ];
      protected $casts = [
          'email_verified_at' => 'datetime',
      ];
      public function getNameAttribute():string
      {
        return "$this->first_name $this->last_name";
      }
}
