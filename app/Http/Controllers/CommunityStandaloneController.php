<?php

namespace App\Http\Controllers;

use App\Standalone;
use App\Community;
use Illuminate\Http\Request;

class CommunityStandaloneController extends Controller
{
    public function store(Community $community , Standalone $standalone)
    {
      if (!$community->standalones->contains($standalone)) {
        $community->standalones()->save($standalone);
        $community->save();
      }
      else {
        return false;
      }
    }
    public function destroy(Community $community , Standalone $standalone)
    {
      if ($community->standalones->contains($standalone)) {
        $standalone->community()->dissociate();
        $standalone->save();
      }
      else {
        return false;
      }
    }
}
