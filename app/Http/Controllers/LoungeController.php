<?php

namespace App\Http\Controllers;

use App\Plan;
use App\User;
use App\Wishlist;
use Illuminate\Http\Request;

class LoungeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('guest:admin');
      $this->middleware('guest:company');
      $this->middleware('guest:owner');
      $this->middleware('guest:agent');
    }

    public function index()
    {
        $user = auth()->user();
        $user->load('bookings','visits','favourite_rentals','favourite_hostels','favourite_standalones','favourite_workspaces','favourite_communities','diaryEntries');
        $rental_bookings = collect([]);
        $hostel_bookings = collect([]);
        $workspace_bookings = collect([]);
        foreach ($user->bookings as $booking) {
          if (count($booking->rental_bookings)) {
            $booking->loadMissing('rental_bookings.ratings');
            foreach ($booking->rental_bookings as $rental_booking) {
              $rental_bookings->push($rental_booking);
            }
          }
          if ($booking->hostel_bookings->count()) {
            $booking->loadMissing('hostel_bookings.ratings');
            foreach ($booking->hostel_bookings as $hostel_booking) {
              $hostel_bookings->push($hostel_booking);
            }
          }
          if ($booking->workspace_bookings->count()) {
            $booking->loadMissing('workspace_bookings.ratings');
            foreach ($booking->workspace_bookings as $workspace_booking) {
              $workspace_bookings->push($workspace_booking);
            }
          }
        }
        // dd($rental_bookings);
        $favourites = $user->favourite_rentals->count() + $user->favourite_hostels->count() + $user->favourite_workspaces->count() + $user->favourite_standalones->count();
        return view('lounge' , compact('user','favourites','rental_bookings','hostel_bookings','workspace_bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
