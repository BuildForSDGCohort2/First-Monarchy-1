<?php

namespace App\Http\Controllers;

use App\Standalone;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StandaloneController extends Controller
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
       $standalones = Standalone::with('images')->get();
        return view('properties.list',compact('standalones'));
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
      		 'description'=>['required','min:10','max:255'],
           'bedrooms'=>['required','integer','min:0'],
           'bathrooms'=>['required','integer','min:0'],
           'plot_size'=>['required','string','min:0'],
           'parking_slots'=>['required','integer','min:0'],
           'selling_price'=>['required','integer','min:0'],
           'area'=>['required','integer','min:0'],
           'location' =>['required' ,'string','min:0'],
           'year_built'=>['required','date'],
           'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
           'propertyPhotos.*' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
        ]);
        $coverImagePath = $request->file('propertyCoverPhoto')->store('public/StandaloneCoverPhotos');
        $newStandalone = new Standalone($validated + ['coverImage' =>$coverImagePath]);
        if (auth()->guard('owner')->check()) {
          $newStandalone = auth()->guard('owner')->user()->standalones()->save($newStandalone);
        }
        if (auth()->guard('agent')->check()) {
          $newStandalone = auth()->guard('agent')->user()->standalones()->save($newStandalone);
        }
        foreach($request->file('propertyPhotos') as $image) {
          $path = $image->store('public/standalonePhotos');
          $newImage = new Image(['url' => $path]);
          $newImage = $newStandalone->images()->save($newImage);
        }
        $standalone = $newStandalone;

        return view('properties.owner.partials.standalones',compact('standalone'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Standalone  $standalone
     * @return \Illuminate\Http\Response
     */
    public function show(Standalone $standalone)
    {
       views($standalone)->record();
       $standalone->load('images');
       $standalone->load('standaloneable');
        return view('properties.standalones',compact('standalone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Standalone  $standalone
     * @return \Illuminate\Http\Response
     */
    public function edit(Standalone $standalone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Standalone  $standalone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Standalone $standalone)
    {
      if (!$request->hasFile('propertyCoverPhoto') && !$request->hasFile('propertyPhoto')) {
            $validated = $request->validate([
          		 'name' => ['required', 'min:3','string'],
          		 'description'=>['required','min:10','max:255'],
               'bedrooms'=>['required','integer','min:0'],
               'bathrooms'=>['required','integer','min:0'],
               'plot_size'=>['required','string','min:0'],
               'parking_slots'=>['required','integer','min:0'],
               'selling_price'=>['required','integer','min:0'],
               'area'=>['required','integer','min:0'],
               'year_built'=>['required','date'],
               'location' =>['required' ,'string','min:0'],
            ]);
            $standalone->update($validated);
      }

          if ($request->hasFile('propertyCoverPhoto')) {
            $request->validate([
             'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
            ]);
            Storage::delete($standalone->coverImage);
            $coverImagePath = $request->file('propertyCoverPhoto')->store('public/StandaloneCoverPhotos');
            $standalone->update(['coverImage' => $coverImagePath]);
          }
          if ($request->hasFile('propertyPhoto')) {
              $request->validate([
               'propertyPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
              ]);
                $path = $request->file('propertyPhoto')->store('public/standalonePhotos');
                $newImage = new Image(['url' => $path]);
                $newImage = $standalone->images()->save($newImage);
                $image = $newImage;
                return view('properties.owner.partials.image',compact('image'))->render();
            }
            $standalone->load('images');
            return view('properties.owner.partials.standalones',compact('standalone'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Standalone  $standalone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Standalone $standalone)
    {
        foreach($standalone->images as $image) {
            Storage::delete($image->url);
        }
        Storage::delete($standalone->coverImage);
        $standalone->images()->delete();
        $standalone->ratings()->delete();
        $standalone->delete();
        return;
    }
}
