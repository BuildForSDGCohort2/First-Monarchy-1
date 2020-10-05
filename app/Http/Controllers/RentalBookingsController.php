<?php

namespace App\Http\Controllers;

use App\Rental;
use Illuminate\Http\Request;

class RentalBookingsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['index']);
    $this->middleware('guest:admin')->except(['index']);
    $this->middleware('guest:company')->except(['index']);
    $this->middleware('guest:agent')->except(['index']);
    $this->middleware('guest:owner')->except(['index']);
    $this->middleware('auth:owner')->only(['index']);
  }
  public function index(Rental $rental)
  {
    $bookings = $rental->bookings;
    foreach ($bookings as $booking) {
      $booking->load('user');
    }
    $view = view('properties.owner.partials.bookings',compact('bookings','rental'))->render();
    return $view;
  }
    public function store(Rental $rental)
    {
      if (!$rental->has_available_units()) {
        return false;
      }
      if ($rental->is_booked()) {
        return false;
      }
      $rental->book();
    }
    public function destroy(Rental $rental)
    {
      if ($rental->is_booked()) {
        $booking = $rental->bookings()->where('user_id',auth()->id())->first();
        $rental->cancel_booking($booking);
      }
      else {
        return false;
      }
    }
}
