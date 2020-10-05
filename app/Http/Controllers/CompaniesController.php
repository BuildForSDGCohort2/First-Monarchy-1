<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Category;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class CompaniesController extends Controller
{
        public function __construct()
        {
          $this->middleware('auth:company')->except(['destroy','show']);
          $this->middleware('auth:admin')->only('destroy');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('properties.company-profile',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
      if (!$request->hasFile('logo')) {
        $validated = request()->validate([
         'name' => ['required', 'string', 'max:255'],
         'bio' => ['required', 'string', 'max:255'],
         // 'email' => ['required', 'string', 'email', 'max:255', 'unique:companies,email,'.$company->id],
         'logo'=>['sometimes','required','image','mimes:jpeg,jpg,png','max:2048'],
         'phone' =>['required','string','min:0','max:10'],
         'address' =>['required','string','min:0'],
        ]);
         $company->update($validated);
      }
       if ($request->hasFile('logo')){
              Storage::delete($company->logo);
              $path = $request->file('logo')->store('public/companyLogos');
              $company->logo = $path;
              $company->save();
       }
  		 return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Storage::delete($company->logo);
        $company->categories()->detach();
        foreach ($company->posts as $post) {
          $post->tags()->detach();
          foreach ($post->images as $image) {
            $image->delete();
            Storage::delete($image->url);
          }
          $post->delete();
        }
        Tag::where('name',$company->name)->delete();
        $company->delete();
   		  return;
    }
}
