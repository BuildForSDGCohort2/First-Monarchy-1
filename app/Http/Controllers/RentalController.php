<?php

namespace App\Http\Controllers;

use App\Rental;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:owner')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->has('bedrooms') ||$request->has('bathrooms') ||$request->has('parking_slots') ||$request->has('min_rent') ||$request->has('max_rent') ) {
        $request->validate([
          'bedrooms'=>['required_without_all:bathrooms,parking_slots,min_rent,max_rent'],
          'bathrooms'=>['required_without_all:bedrooms,parking_slots,min_rent,max_rent'],
          'parking_slots'=>['required_without_all:bedrooms,bathrooms,min_rent,max_rent'],
          'min_rent'=>['required_without_all:bedrooms,bathrooms,parking_slots,max_rent'],
          'max_rent'=>['required_without_all:bedrooms,bathrooms,parking_slots,min_rent'],
          'location'=>['min:0','nullable','string','min:0'],
        ]);
         if ($request->filled('bedrooms')) {
           $rentals = Rental::where('bedrooms','=',$request->query('bedrooms'))->get();
         }
         elseif ($request->filled('bathrooms')) {
           $rentals = Rental::where('bathrooms','=',$request->query('bathrooms'))->get();
         }
         elseif ($request->filled('parking_slots')) {
           $rentals = Rental::where('parking_slots','=',$request->query('parking_slots'))->get();
         }
         elseif ($request->filled('min_rent')) {
           $rentals = Rental::where('rent','>=',$request->query('min_rent'))->get();
         }
         elseif ($request->filled('max_rent')) {
           $rentals = Rental::where('rent','<=',$request->query('max_rent'))->get();
         }
         elseif ($request->has('clearFilters')) {
           $rentals = Rental::all();
         }
       }
         else{
           $rentals = Rental::all();
         }
        return view('properties.list',compact('rentals'));
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
      		 'name' => ['required','min:3','string'],
      		 'description'=>['required','min:0'],
           'bedrooms'=>['required','integer','min:0'],
           'bathrooms'=>['required','integer','min:0'],
           'parking_slots'=>['required','integer','min:0'],
           'rent'=>['required','integer','min:0'],
           'units_available'=>['required','integer','min:0'],
           'location' =>['required' ,'string','min:0'],
           'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:15000'],
           'propertyPhotos.*' =>['required','image','mimes:jpeg,jpg,png','max:15000'],
        ]);
        $coverImagePath = $request->file('propertyCoverPhoto')->store('public/RentalCoverPhotos');
        $newRental = new Rental($validated + ['coverImage' =>$coverImagePath]);
        if (auth()->guard('owner')->check()) {
          $newRental = auth()->guard('owner')->user()->rentals()->save($newRental);
        }
        if (auth()->guard('agent')->check()) {
          $newRental = auth()->guard('agent')->user()->rentals()->save($newRental);
        }
        foreach($request->file('propertyPhotos') as $image) {
          $path = $image->store('public/rentalPhotos');
          $newImage = new Image(['url' => $path]);
          $newImage = $newRental->images()->save($newImage);
        }
        $rental = $newRental;

        return view('properties.owner.partials.rentals',compact('rental'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
       views($rental)->record();
       $rental->load('images');
       $rental->load('rentalable');
        return view('properties.rentals',compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
      if (!$request->hasFile('propertyCoverPhoto') && !$request->hasFile('propertyPhoto')) {
            $validated = $request->validate([
          		 'name' => ['required', 'min:3','string'],
          		 'description'=>['required','min:10','max:255'],
               'bedrooms'=>['required','integer','min:1'],
               'bathrooms'=>['required','integer','min:1'],
               'parking_slots'=>['required','integer','min:0'],
               'rent'=>['required','integer','min:0'],
               'units_available'=>['required','integer','min:0'],
               'location' =>['required' ,'string','min:0'],
            ]);
            $rental->update($validated);
      }
          if ($request->hasFile('propertyCoverPhoto')) {
            $request->validate([
             'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
            ]);
            Storage::delete($rental->coverImage);
            $coverImagePath = $request->file('propertyCoverPhoto')->store('public/RentalCoverPhotos');
            $rental->update(['coverImage' => $coverImagePath]);
          }
          if ($request->hasFile('propertyPhoto')) {
              $request->validate([
               'propertyPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
              ]);
                $path = $request->file('propertyPhoto')->store('public/rentalPhotos');
                $newImage = new Image(['url' => $path]);
                $newImage = $rental->images()->save($newImage);
                $image = $newImage;
                return view('properties.owner.partials.image',compact('image'))->render();
            }
            $rental->load('images');

          return view('properties.owner.partials.rentals',compact('rental'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        foreach($rental->images as $image) {
              Storage::delete($image->url);
          }
          Storage::delete($rental->coverImage);
          $rental->images()->delete();
          $rental->ratings()->delete();
          $rental->delete();
          return;
    }
}
