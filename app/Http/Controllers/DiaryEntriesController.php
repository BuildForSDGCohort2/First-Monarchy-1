<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class DiaryEntriesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('guest:company');
    $this->middleware('guest:admin');
  }
  public function show()
  {

    $diary = auth()->user()->diaryEntries;
    return view('properties.tag',compact('diary'));
  }
    public function store(Post $post)
    {
      if(!auth()->user()->diaryEntries->contains($post->id)){
      $post->addToDiary($post);
      }
      return;
    }
    public function destroy(Post $post)
    {
    if(auth()->user()->diaryEntries->contains($post->id)){
      $post->removeFromDiary($post);
    }
     return;
    }
}
