<?php

namespace App\Http\Controllers;

use App\Rental;
use App\Standalone;
use App\Workspace;
use App\Hostel;
use App\Community;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
  public function index()
 {
   $mostPopularRental = Rental::orderByViews()->first();
   $mostPopularHostel = Hostel::orderByViews()->first();
   $mostPopularStandalone = Standalone::orderByViews()->first();
   $mostPopularWorkspace = Workspace::orderByViews()->first();
   $mostPopularCommunity = Community::orderByViews()->first();

   return view('properties.all',compact('mostPopularRental','mostPopularHostel','mostPopularWorkspace','mostPopularStandalone','mostPopularCommunity'));
  }
}
