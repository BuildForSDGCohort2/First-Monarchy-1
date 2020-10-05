<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Image;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $ids = Tag::all()->pluck('id')->implode(',');
        $validated = $request->validate([
          'postImage' => ['required','image','mimes:png,jpg,jpeg' ,'max:4000'],
          'tags' => ['required','array','min:1'],
          'tags.*' => ["in:$ids"],
        ],
        ['tags.required' => 'please select the appropriate tags for this post'],
      );
        $newpost = new Post();
        $newpost = auth('company')->user()->posts()->save($newpost);
        $newpost->tags()->attach($request->input('tags'));
        $newpost->tags()->attach(Tag::where('name',auth()->guard('company')->user()->name)->first()->id);

          $path = $validated['postImage']->store('public/postPhotos');
          $newImage = new Image(['url' => $path]);
          $newImage = $newpost->images()->save($newImage);
          $newpost = $newpost->load('images');

        return $newpost;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // return view('properties.post',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $post->tags()->detach();
        foreach ($post->images as $image) {
          Storage::delete($image->url);
        }
        $post->images()->delete();
        $post->delete();
         return ;
    }
}
