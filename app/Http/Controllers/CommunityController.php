<?php

namespace App\Http\Controllers;

use App\Community;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
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
       $communities = Community::with('images')->get();
        return view('properties.list',compact('communities'));
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
           'location' =>['required' ,'string','min:0'],
           'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
           'propertyPhotos.*' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
        ]);
        $coverImagePath = $request->file('propertyCoverPhoto')->store('public/CommunityCoverPhotos');
        $newCommunity = new Community($validated + ['coverImage' =>$coverImagePath]);
        if (auth()->guard('owner')->check()) {
          $newCommunity = auth()->guard('owner')->user()->communities()->save($newCommunity);
        }
        if (auth()->guard('agent')->check()) {
          $newCommunity = auth()->guard('agent')->user()->communities()->save($newCommunity);
        }
        foreach($request->file('propertyPhotos') as $image) {
          $path = $image->store('public/communityPhotos');
          $newImage = new Image(['url' => $path]);
          $newImage = $newCommunity->images()->save($newImage);
        }
        $community = $newCommunity;
        return view('properties.owner.partials.communities',compact('community'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
      views($community)->record();
       $community->load('images');
       $community->load('communityable');
       $community->load(['rentals','hostels','standalones','workspaces']);
        return view('properties.communities',compact('community'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
      if (!$request->hasFile('propertyCoverPhoto') && !$request->hasFile('propertyPhoto')) {
          $validated = $request->validate([
        		 'name' => ['required', 'min:3','string'],
        		 'description'=>['required','min:10','max:255'],
             'location' =>['required' ,'string','min:0'],
          ]);
          $community->update($validated);
      }

          if ($request->hasFile('propertyCoverPhoto')) {
            $request->validate([
             'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
            ]);
            Storage::delete($community->coverImage);
            $coverImagePath = $request->file('propertyCoverPhoto')->store('public/CommunityCoverPhotos');
            $community->update(['coverImage' => $coverImagePath]);
          }
          if ($request->hasFile('propertyPhoto')) {
              $request->validate([
               'propertyPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
              ]);
                $path = $request->file('propertyPhoto')->store('public/communityPhotos');
                $newImage = new Image(['url' => $path]);
                $newImage = $community->images()->save($newImage);
                $image = $newImage;
                return view('properties.owner.partials.image',compact('image'))->render();
            }
            $community->load('images');
            return view('properties.owner.partials.communities',compact('community'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        foreach($community->images as $image) {
              Storage::delete($image->url);
          }
          Storage::delete($community->coverImage);
          $community->images()->delete();
          $community->delete();
    }
}
