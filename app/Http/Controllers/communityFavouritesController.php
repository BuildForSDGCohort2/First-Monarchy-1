<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;

class communityFavouritesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('guest:admin');
      $this->middleware('guest:company');
      $this->middleware('guest:owner');
      $this->middleware('guest:agent');
    }
    public function store(Community $community)
    {
      if (!auth()->user()->favourite_communities->contains($community)) {
        $community->addToFavourites($community);
      }
      return;
    }
    public function destroy(Community $community)
    {
      if (auth()->user()->favourite_communities->contains($community)) {
        $community->removeFromFavourites($community);
      }
      return;
    }
}
