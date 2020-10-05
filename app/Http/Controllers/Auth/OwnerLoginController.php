<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class OwnerLoginController extends Controller
{
          use AuthenticatesUsers;

              protected $redirectTo = '/owners';

                public function __construct()
                {
                    $this->middleware('guest')->except('logout');
                    $this->middleware('guest:admin')->except('logout');
                    $this->middleware('guest:company')->except('logout');
                    $this->middleware('guest:owner')->except('logout');
                    $this->middleware('guest:agent')->except('logout');
                }
                protected function guard()
                {
                    return Auth::guard('owner');
                }
                public function showLoginForm()
                {
                  return view('properties.ownerLogin');
                }
}
