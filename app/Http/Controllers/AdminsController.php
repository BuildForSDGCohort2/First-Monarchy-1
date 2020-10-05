<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Admin;
use App\Owner;
use App\Company;
use App\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth:admin');
    }
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
       //Handled by the AdminRegisterController
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
       $categories = Category::paginate(5,['*'],'categories');
       $companies = Company::paginate(5,['*'],'companies');
       $owners = Owner::orderBy('name','asc')->paginate(4,['*'],'owners');
       $owners->loadCount(['rentals','workspaces','hostels','communities','standalones']);
       $users = User::orderBy('first_name','asc')->paginate(5,['*'],'users');
       $admins = Admin::orderBy('first_name','asc')->paginate(5,['*'],'admins');
       $tags = Tag::where('origin','admin')->paginate(5,['*'],'tags');
       return view('admin',compact('admin','categories','users','companies','admins','tags','owners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
      if (!$request->hasFile('avatar')) {
        $validated = request()->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,'.$admin->id],
        ]);
        $admin->update($validated);
      }
        if ($request->hasFile('avatar')) {
          request()->validate([
            'avatar'=>['sometimes','required','image','mimes:jpeg,jpg,png','max:2048'],
          ]);
       Storage::delete($admin->avatar);
       $path = $request->file('avatar')->store('public/adminAvatars');
       $admin->avatar = $path;
       $admin->save();
        }

  		 return $admin;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        Storage::delete($admin->avatar);
        $admin->delete();
        return;
    }
}
