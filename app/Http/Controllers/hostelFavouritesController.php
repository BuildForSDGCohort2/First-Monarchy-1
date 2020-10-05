<?php

namespace App\Http\Controllers;

use App\Hostel;
use Illuminate\Http\Request;

class hostelFavouritesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('guest:admin');
      $this->middleware('guest:company');
      $this->middleware('guest:owner');
      $this->middleware('guest:agent');
    }
    public function store(Hostel $hostel)
    {
      if (!auth()->user()->favourite_hostels->contains($hostel)) {
        $hostel->addToFavourites($hostel);
      }
      return;
    }
    public function destroy(Hostel $hostel)
    {
      if (auth()->user()->favourite_hostels->contains($hostel)) {
        $hostel->removeFromFavourites($hostel);
      }
      return;
    }
}
