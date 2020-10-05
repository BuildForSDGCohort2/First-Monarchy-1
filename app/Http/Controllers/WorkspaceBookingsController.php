<?php

namespace App\Http\Controllers;

use App\Workspace;
use Illuminate\Http\Request;

class WorkspaceBookingsController extends Controller
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
    public function index(Workspace $workspace)
    {
      $bookings = $workspace->bookings;
      foreach ($bookings as $booking) {
        $booking->load('user');
      }
      $view = view('properties.owner.partials.bookings',compact('bookings','workspace'))->render();
      return $view;
    }
    public function store(Workspace $workspace)
    {
      if (!$workspace->has_available_units()) {
        return false;
      }
      if ($workspace->is_booked()) {
        return false;
      }
      $workspace->book();
    }
    public function destroy(Workspace $workspace)
    {
      $booking = $workspace->bookings()->where('user_id',auth()->id())->first();
      $workspace->cancel_booking($booking);
    }
}
