<?php

namespace App;
use App\Visit;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Owner extends Authenticatable
{
    use Notifiable;

        protected $guard = 'owner';

        protected $fillable = [
            'name' , 'bio' , 'email' , 'logo' , 'phone_number' , 'country_code', 'password'
        ];
        protected $hidden = [
            'password', 'remember_token',
        ];
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
    public function rentals()
    {
      return $this->morphMany('App\Rental', 'rentalable');
    }
    public function hostels()
    {
      return $this->morphMany('App\Hostel', 'hostelable');
    }
    public function standalones()
    {
      return $this->morphMany('App\Standalone' , 'standaloneable');
    }
    public function workspaces()
    {
      return $this->morphMany('App\Workspace','workspaceable');
    }
    public function communities()
    {
      return $this->morphMany('App\Community','communityable');
    }
    public function getPropertiesAttribute()
    {
      $properties = collect($this->rentals->all());
      foreach ($this->hostels as $hostel) {
        $properties->push($hostel);
      }
      foreach ($this->standalones as $standalone) {
        $properties->push($standalone);
      }
      foreach ($this->workspaces as $workspace) {
        $properties->push($workspace);
      }
      return $properties;
    }
    public function getVisitsAttribute()
    {
      $visits = collect([]);
      foreach ($this->properties as $property) {
        foreach ($property->visits as $visit) {
          $visits->push($visit);
        }
      }
      return $visits;
    }
}
