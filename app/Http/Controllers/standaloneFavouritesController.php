<?php

namespace App\Http\Controllers;

use App\Standalone;
use Illuminate\Http\Request;

class standaloneFavouritesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('guest:admin');
      $this->middleware('guest:company');
      $this->middleware('guest:owner');
      $this->middleware('guest:agent');
    }
    public function store(Standalone $standalone)
    {
      if (!auth()->user()->favourite_standalones->contains($standalone)) {
        $standalone->addToFavourites($standalone);
      }
      return;
    }
    public function destroy(Standalone $standalone)
    {
      if (auth()->user()->favourite_standalones->contains($standalone)) {
        $standalone->removeFromFavourites($standalone);
      }
      return;
    }
}
