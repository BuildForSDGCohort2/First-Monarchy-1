<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth:owner')->except(['index','show']);
    }
    public function index()
    {
       $hostels = Hostel::with('images')->get();
        return view('properties.list',compact('hostels'));
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
        $validated = $request->validate([
      		 'name' => ['required', 'min:3','string'],
      		 'description'=>['required','min:10','max:255'],
           'beds'=>['required','integer','min:0'],
           'gender'=>['required','string',"in:male,female,all"],
           'rent'=>['required','integer','min:0'],
           'units_available'=>['required','integer','min:0'],
           'location' =>['required' ,'string','min:0'],
           'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
           'propertyPhotos.*' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
        ],
      ['gender.in' => 'Please select a gender'],
    );
        $coverImagePath = $request->file('propertyCoverPhoto')->store('public/HostelCoverPhotos');
        $newHostel = new Hostel($validated + ['coverImage' =>$coverImagePath]);
        if (auth()->guard('owner')->check()) {
          $newHostel = auth()->guard('owner')->user()->hostels()->save($newHostel);
        }
        if (auth()->guard('agent')->check()) {
          $newHostel = auth()->guard('agent')->user()->hostels()->save($newHostel);
        }
        foreach($request->file('propertyPhotos') as $image) {
          $path = $image->store('public/hostelPhotos');
          $newImage = new Image(['url' => $path]);
          $newImage = $newHostel->images()->save($newImage);
        }
        $hostel = $newHostel;

        return view('properties.owner.partials.hostels',compact('hostel'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $hostel)
    {
       views($hostel)->record();
       $hostel->load('images');
       $hostel->load('hostelable');
        return view('properties.hostels',compact('hostel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hostel $hostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostel $hostel)
    {
      if (!$request->hasFile('propertyCoverPhoto') && !$request->hasFile('propertyPhoto')) {
          $validated = $request->validate([
        		 'name' => ['required', 'min:3','string'],
        		 'description'=>['required','min:10','max:255'],
             'beds'=>['required','integer','min:0'],
             'rent'=>['required','integer','min:0'],
             'units_available'=>['required','integer','min:0'],
             'location' =>['required' ,'string','min:0'],
             'gender'=>['required','in:male,female,all'],
          ],
          ['gender.in' => 'Please select a gender'],
        );
        $hostel->update($validated);
      }
          if ($request->hasFile('propertyCoverPhoto')) {
            $request->validate([
             'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
            ]);
            Storage::delete($hostel->coverImage);
            $coverImagePath = $request->file('propertyCoverPhoto')->store('public/HostelCoverPhotos');
            $hostel->update(['coverImage' => $coverImagePath]);
          }
          if ($request->hasFile('propertyPhoto')) {
              $request->validate([
               'propertyPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
              ]);
                $path = $request->file('propertyPhoto')->store('public/hostelPhotos');
                $newImage = new Image(['url' => $path]);
                $newImage = $hostel->images()->save($newImage);
                $image = $newImage;
                return view('properties.owner.partials.image',compact('image'))->render();
            }
            $hostel->load('images');

            return view('properties.owner.partials.hostels',compact('hostel'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hostel $hostel)
    {
          foreach($hostel->images as $image) {
              Storage::delete($image->url);
          }
          Storage::delete($hostel->coverImage);
          $hostel->images()->delete();
          $hostel->ratings()->delete();
          $hostel->delete();
          return;
    }
}
