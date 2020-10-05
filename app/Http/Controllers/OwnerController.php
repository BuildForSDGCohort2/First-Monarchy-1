<?php

namespace App\Http\Controllers;

use App\Owner;
use App\Rental;
use App\Standalone;
use App\Hostel;
use App\Workspace;
use App\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth:owner')->except(['show','destroy']);
       $this->middleware('auth:admin')->only('destroy');
     }
    public function index()
    {
        $rentals = auth()->guard('owner')->user()->rentals()->with(['bookings','community'])->paginate(5,['*'],'rentals')->onEachSide(1);

        $hostels = auth()->guard('owner')->user()->hostels()->with(['bookings','community'])->paginate(9,['*'],'hostels')->onEachSide(1);

        $standalones = auth()->guard('owner')->user()->standalones()->with(['community'])->paginate(9,['*'],'standalones')->onEachSide(1);

        $workspaces = auth()->user()->workspaces()->with(['bookings','community'])->paginate(15,['*'],'workspaces')->onEachSide(1);

        $communities = auth()->guard('owner')->user()->communities()->with(['rentals','hostels','standalones','workspaces'])->paginate(15,['*'],'communities')->onEachSide(1);

        return view('properties.owner',compact('rentals','hostels','standalones','workspaces','communities'));
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
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
      return view('properties.owners',compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
      if (!$request->hasFile('logo')) {
        $validated = $request->validate([
              'name' => ['required', 'string', 'max:255'],
              'bio' => ['required', 'string', 'min:0'],
              // 'email' => ['required', 'string', 'email', 'max:255', 'unique:owners,email,'.$owner->id],
        ]);
        $owner->update($validated);
      }
      if ($request->hasFile('logo')) {
        Storage::delete($owner->logo);
         $request->validate([
            'logo' =>['required','image','mimes:jpeg,jpg,png','max:2048'],
         ]);
         $logoPath = $request->file('logo')->store('public/ownerLogos');
         $owner->update(['logo' => $logoPath]);
      }
            return $owner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
      // dd($owner);
      foreach ($owner->rentals as $rental) {
          foreach($rental->images as $image) {
                Storage::delete($image->url);
            }
            Storage::delete($rental->coverImage);
            $rental->images()->delete();
            $rental->ratings()->delete();
            $rental->delete();
      }
      foreach ($owner->hostels as $hostel) {
          foreach($hostel->images as $image) {
                Storage::delete($image->url);
            }
            Storage::delete($hostel->coverImage);
            $hostel->images()->delete();
            $hostel->ratings()->delete();
            $hostel->delete();
      }
      foreach ($owner->workspaces as $workspace) {
          foreach($workspace->images as $image) {
                Storage::delete($image->url);
            }
            Storage::delete($workspace->coverImage);
            $workspace->images()->delete();
            $workspace->ratings()->delete();
            $workspace->delete();
      }
      foreach ($owner->standalones as $standalone) {
          foreach($standalone->images as $image) {
                Storage::delete($image->url);
            }
            Storage::delete($standalone->coverImage);
            $standalone->images()->delete();
            $standalone->ratings()->delete();
            $standalone->delete();
      }
      foreach ($owner->communities as $community) {
          foreach($community->images as $image) {
                Storage::delete($image->url);
            }
            Storage::delete($community->coverImage);
            $community->images()->delete();
            $community->ratings()->delete();
            $community->delete();
      }
        Storage::delete($owner->logo);
        $owner->delete();
    }
}
