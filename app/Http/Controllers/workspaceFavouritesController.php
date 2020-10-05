<?php

namespace App\Http\Controllers;

use App\Workspace;
use Illuminate\Http\Request;

class workspaceFavouritesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('guest:admin');
      $this->middleware('guest:company');
      $this->middleware('guest:owner');
      $this->middleware('guest:agent');
    }
    public function store(Workspace $workspace)
    {
      if (!auth()->user()->favourite_workspaces->contains($workspace)) {
        $workspace->addToFavourites($workspace);
      }
      return;
    }
    public function destroy(Workspace $workspace)
    {
      if (auth()->user()->favourite_workspaces->contains($workspace)) {
        $workspace->removeFromFavourites($workspace);
      }
      return;
    }
}
