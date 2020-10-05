<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
      use Notifiable;

          protected $guard = 'agent';

          protected $fillable = [
              'name' , 'bio' , 'email' , 'logo' , 'phone_number' , 'country_code', 'password',
          ];
          protected $hidden = [
              'password', 'remember_token',
          ];
          protected $casts = [
              'email_verified_at' => 'datetime',
          ];

      public function phones()
      {
        return $this->morphMany('App\Phone' , 'phoneable');
      }
      public function rentals()
      {
        return $this->morphMany('App\Rental' , 'rentalable');
      }
      public function hostels()
      {
        return $this->morphMany('App\Hostel' , 'hostelable');
      }
      public function workspaces()
      {
        return $this->morphMany('App\Workspace' , 'workspaceable');
      }
      public function standalones()
      {
        return $this->morphMany('App\Standalone' , 'standaloneable');
      }
}
