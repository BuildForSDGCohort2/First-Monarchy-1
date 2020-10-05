<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Company;
use Illuminate\Http\Request;

class companyAdminAreaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth:company');
     }
    public function show()
    {
        $posts = auth()->guard('company')->user()->posts;
        $posts->load('images');
        return view('company',compact('posts'));
    }
}
