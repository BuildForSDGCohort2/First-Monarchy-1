<?php

namespace App\Http\Controllers;

use App\Workspace;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkspaceController extends Controller
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
       $workspaces = Workspace::with('images')->get();
        return view('properties.list',compact('workspaces'));
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
           'area'=>['required','integer','min:0'],
           'rent'=>['required','integer','min:0'],
           'units_available'=>['required','integer','min:0'],
           'location' =>['required' ,'string','min:0'],
           'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
           'propertyPhotos.*' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
        ]);
        $coverImagePath = $request->file('propertyCoverPhoto')->store('public/WorkspaceCoverPhotos');
        $newWorkspace = new Workspace($validated + ['coverImage' =>$coverImagePath]);
        if (auth()->guard('owner')->check()) {
          $newWorkspace = auth()->guard('owner')->user()->workspaces()->save($newWorkspace);
        }
        if (auth()->guard('agent')->check()) {
          $newWorkspace = auth()->guard('agent')->user()->workspaces()->save($newWorkspace);
        }
        foreach($request->file('propertyPhotos') as $image) {
          $path = $image->store('public/workspacePhotos');
          $newImage = new Image(['url' => $path]);
          $newImage = $newWorkspace->images()->save($newImage);
        }
        $workspace = $newWorkspace;

        return view('properties.owner.partials.workspaces',compact('workspace'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workspace  $workspace
     * @return \Illuminate\Http\Response
     */
    public function show(Workspace $workspace)
    {
       views($workspace)->record();
       $workspace->load('images');
       $workspace->load('workspaceable');
        return view('properties.workspaces',compact('workspace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workspace  $workspace
     * @return \Illuminate\Http\Response
     */
    public function edit(Workspace $workspace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workspace  $workspace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workspace $workspace)
    {
      if (!$request->hasFile('propertyCoverPhoto') && !$request->hasFile('propertyPhoto')) {
          $validated = $request->validate([
        		 'name' => ['required', 'min:3','string'],
        		 'description'=>['required','min:10','max:255'],
             'area'=>['required','integer','min:0'],
             'rent'=>['required','integer','min:0'],
             'units_available'=>['required','integer','min:0'],
             'location' =>['required' ,'string','min:0'],
          ]);
          $workspace->update($validated);
      }
          if ($request->hasFile('propertyCoverPhoto')) {
            $request->validate([
             'propertyCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
            ]);
            Storage::delete($workspace->coverImage);
            $coverImagePath = $request->file('propertyCoverPhoto')->store('public/WorkspaceCoverPhotos');
            $workspace->update(['coverImage' => $coverImagePath]);
          }
          if ($request->hasFile('propertyPhoto')) {
              $request->validate([
               'propertyPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
              ]);
                $path = $request->file('propertyPhoto')->store('public/workspacePhotos');
                $newImage = new Image(['url' => $path]);
                $newImage = $workspace->images()->save($newImage);
                $image = $newImage;
                return view('properties.owner.partials.image',compact('image'))->render();
            }
            $workspace->load('images');
            return view('properties.owner.partials.workspaces',compact('workspace'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workspace  $workspace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workspace $workspace)
    {
        foreach($workspace->images as $image) {
              Storage::delete($image->url);
          }
          Storage::delete($workspace->coverImage);
          $workspace->images()->delete();
          $workspace->ratings()->delete();
          $workspace->delete();
          return;
    }
}
