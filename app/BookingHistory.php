<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    protected $fillable = [
      'property_name','type_booked','number_of_units','user_id','status',
    ];
}
