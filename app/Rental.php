<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Rental extends Model implements ViewableContract
{
  use Viewable;

   protected $fillable =['name','description','bedrooms','bathrooms','parking_slots','location','units_available','rent','coverImage'];

   protected $with = ['ratings'];

    public function images()
    {
      return $this->morphMany('App\Image' , 'imageable');
    }
    public function visits()
    {
      return $this->morphMany('App\Visit' , 'visitable');
    }
    public function ratings()
    {
      return $this->morphMany('App\Rating' , 'rateable');
    }
    public function rentalable()
    {
      return $this->morphTo();
    }
    public function likes()
    {
      return $this->morphToMany('App\User' , 'likeable');
    }
    public function bookings()
    {
      return $this->morphToMany('App\Booking','bookable');
    }
    public function community()
    {
      return $this->belongsTo('App\Community');
    }
    public function addToFavourites($rental)
    {
      auth()->user()->favourite_rentals()->attach($rental);
    }
    public function removeFromFavourites($rental)
    {
      auth()->user()->favourite_rentals()->detach($rental);
    }
    public function book($number_of_units = 1)
    {
       $booking_details = [
         'property_name'=>$this->name,
         'number_of_units'=>$number_of_units,
         'user_id' =>auth()->id(),
         'type_booked'=>'rental'
       ];
          $booking = Booking::create($booking_details);
          BookingHistory::create($booking_details);
          $this->bookings()->attach($booking);
          $this->decrement('units_available',$number_of_units);
    }
    public function cancel_booking($booking,$number_of_units=1)
    {
      $this->increment('units_available',$number_of_units);
      $this->bookings()->detach($booking);
      $booking->delete();
    }
    public function is_booked()
    {
      if ($this->bookings()->where('user_id',auth()->id())->exists()) {
        return 1;
      }
      else {
        return 0;
      }
    }
    public function has_available_units()
    {
      if ($this->units_available > 0) {
        return 1;
      }
      else {
        return 0;
      }
    }
}
