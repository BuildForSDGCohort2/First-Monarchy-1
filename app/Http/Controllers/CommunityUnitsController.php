<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;

class CommunityUnitsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:owner');
  }
    public function index(Community $community)
    {
      $rentals = $community->rentals;
      $hostels = $community->hostels;
      $workspaces = $community->workspaces;
      $standalones = $community->standalones;
      $view = view('properties.owner.partials.units',compact('rentals','hostels','standalones','workspaces'))->render();
      return $view;
    }
}
