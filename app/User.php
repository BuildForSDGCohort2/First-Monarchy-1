<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name' , 'last_name' , 'email' ,'country_code' , 'phone_number' , 'password' , 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function bookings()
    {
      return $this->hasMany('App\Booking');
    }
    public function visits()
    {
      return $this->hasMany('App\Visit');
    }
    public function booking_history()
    {
      return $this->hasMany('App\BookingHistory');
    }
    public function favourite_rentals()
    {
      return $this->morphedByMany('App\Rental' , 'likeable');
    }
    public function favourite_hostels()
    {
      return $this->morphedByMany('App\Hostel' , 'likeable');
    }
    public function favourite_standalones()
    {
      return $this->morphedByMany('App\Standalone' , 'likeable');
    }
    public function favourite_workspaces()
    {
      return $this->morphedByMany('App\Workspace' , 'likeable');
    }
    public function favourite_communities()
    {
      return $this->morphedByMany('App\Community' , 'likeable');
    }
    public function diaryEntries()
    {
      return $this->morphToMany('App\Post','attachable');
    }
    public function getNameAttribute():string
    {
      return "$this->first_name $this->last_name";
    }
}
