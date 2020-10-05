<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Rental;

class RentalVisitsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
    $this->middleware('guest:admin');
    $this->middleware('guest:owner');
    $this->middleware('guest:agent');
    $this->middleware('guest:company');
  }
  public function index(Rental $rental)
  {
    if (auth()->check()) {
      $visits =  Visit::all();
      return $visits;
    }
    else {
      return false;
    }

  }
    public function store(Request $request,Rental $rental)
    {
      if (!$rental->visits()->where('user_id',auth()->id())->exists()) {
        $validated = $request->validate([
          'start'=>['required','date:Y-m-d\TH:i:s0'],
          'end'=>['required','date:Y-m-d\TH:i:s0'],
        ]);
        $visit = new Visit($validated + ['title'=>auth()->user()->name . " at ,$rental->name" , 'user_id'=>auth()->id()]);
        $rental->visits()->save($visit);
      }
      else {
        return false;
      }
    }
    public function destroy(Request $request,Rental $rental)
    {
      if ($rental->visits()->where('user_id',auth()->id())->exists()) {
        $visit = $rental->where('user_id',auth()->id());
        $rental->visits()->detach($visit);
        $visit->delete();
      }
      else {
        return false;
      }
    }
}
