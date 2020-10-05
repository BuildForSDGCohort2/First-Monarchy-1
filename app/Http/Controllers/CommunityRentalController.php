<?php

namespace App\Http\Controllers;

use App\Rental;
use App\Community;
use Illuminate\Http\Request;

class CommunityRentalController extends Controller
{
    public function store(Community $community , Rental $rental)
    {
      if (!$community->rentals->contains($rental)) {
        $community->rentals()->save($rental);
        $community->save();
      }
      else {
        return false;
      }
    }
    public function destroy(Community $community , Rental $rental)
    {
      if ($community->rentals->contains($rental)) {
        $rental->community()->dissociate();
        $rental->save();
      }
      else {
        return false;
      }
    }
}
