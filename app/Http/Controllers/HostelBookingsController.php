<?php

namespace App\Http\Controllers;

use App\Hostel;
use Illuminate\Http\Request;

class HostelBookingsController extends Controller
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
    public function index(Hostel $hostel)
    {
      $bookings = $hostel->bookings;
      foreach ($bookings as $booking) {
        $booking->load('user');
      }
      $view = view('properties.owner.partials.bookings',compact('bookings','hostel'))->render();
      return $view;
    }
    public function store(Hostel $hostel)
    {
      if (!$hostel->has_available_units()) {
        return false;
      }
      if ($hostel->is_booked()) {
        return false;
      }
      $hostel->book();
    }
    public function destroy(Hostel $hostel)
    {
      if ($hostel->is_booked()) {
        $booking = $hostel->bookings()->where('user_id',auth()->id())->first();
        $hostel->cancel_booking($booking);
      }
      else {
        return false;
      }
    }
}
