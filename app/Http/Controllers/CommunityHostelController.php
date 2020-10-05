<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\Community;
use Illuminate\Http\Request;

class CommunityHostelController extends Controller
{
    public function store(Community $community , Hostel $hostel)
    {
      if (!$community->hostels->contains($hostel)) {
        $community->hostels()->save($hostel);
        $community->save();
      }
      return false;
    }
    public function destroy(Community $community , Hostel $hostel)
    {
      if ($community->hostels->contains($hostel)) {
        $hostel->community()->dissociate();
        $hostel->save();
      }
      else {
        return false;
      }
    }
}
