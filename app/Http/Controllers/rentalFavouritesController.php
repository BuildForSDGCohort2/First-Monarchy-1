<?php

namespace App\Http\Controllers;

use App\Rental;
use Illuminate\Http\Request;

class rentalFavouritesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('guest:admin');
      $this->middleware('guest:company');
      $this->middleware('guest:owner');
      $this->middleware('guest:agent');
    }
    public function store(Rental $rental)
    {
      if (!auth()->user()->favourite_rentals->contains($rental)) {
        $rental->addToFavourites($rental);
      }
      return;
    }
    public function destroy(Rental $rental)
    {
      if (auth()->user()->favourite_rentals->contains($rental)) {
        $rental->removeFromFavourites($rental);
      }
      return;
    }
}
