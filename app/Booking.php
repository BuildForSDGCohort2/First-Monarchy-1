<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable=[
      'property_name','number_of_units','type_booked','user_id','status'
    ];
    protected $with = ['rental_bookings','hostel_bookings','workspace_bookings'];
    
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function rental_bookings()
    {
      return $this->morphedByMany('App\Rental','bookable');
    }
    public function hostel_bookings()
    {
      return $this->morphedByMany('App\Hostel','bookable');
    }
    public function workspace_bookings()
    {
      return $this->morphedByMany('App\Workspace','bookable');
    }
}
