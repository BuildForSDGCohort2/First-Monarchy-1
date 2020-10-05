<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $validated = $request->validate([
      		  'name' => ['required', 'min:3','string'],
      		  'description'=>['required','string','min:10'],
            'categoryCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
        ]);
        $coverImagePath = $request->file('categoryCoverPhoto')->store('public/CategoryCoverPhotos');
        $newCategory = Category::create($validated + ['coverImage' =>$coverImagePath]);
        $newCategory->loadCount('companies');
        return $newCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category->load('companies');
        return view('properties.category-companies',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      if (!$request->hasFile('categoryCoverPhoto')) {
        $validated = $request->validate([
      		  'name' => ['required', 'min:3','string'],
      		  'description'=>['required','min:10'],
        ]);
        $category->update($validated);
      }
        if ($request->hasFile('categoryCoverPhoto')) {
          $request->validate([
           'categoryCoverPhoto' =>['required','image','mimes:jpeg,jpg,png','max:6000'],
          ]);
          Storage::delete($category->coverImage);
          $coverImagePath = $request->file('categoryCoverPhoto')->store('public/CategoryCoverPhotos');
          $category->update(['coverImage' => $coverImagePath]);
        }

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->coverImage);
        $category->delete();
        return;
    }
}
